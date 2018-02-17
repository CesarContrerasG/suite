<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;

use App\Http\Requests;
use App\Http\Requests\Setup\MasterRequest;
use App\Http\Requests\Qore\DepartamentRequest;
use App\Http\Requests\Qore\UsersRequest;
use App\Http\Controllers\Controller;
use App\Sentry\Master;
use App\Sentry\Module;
use App\Sentry\Type;
use App\Sentry\Suite;
use App\Qore\Country;
use App\Qore\Company;
use App\Qore\Departament;
use App\User;

use Validator;

class MastersController extends Controller
{
    public function index()
    {
        $masters = Master::all();
        return view('Sentry.masters.index', compact('masters'));
    }

    public function create()
    {
        $countries = Country::pluck('pai_nombre', 'id');
        return view('Sentry.masters.create', compact('countries'));
    }

    public function store(MasterRequest $request)
    {
        Master::create($request->all());
        $master = Master::where('rfc', $request->get('rfc'))->first();
        $data = $request->except('db');
        $rfc = $request->get('rfc');
        $registered = $request->get('registered');
        $company = Company::where('rfc', $rfc)->first();

        if($registered == 1 && count($company) > 0)
        {
            $company->master_id = $master->id;
            $company->save();
            if($request->hasFile('logo') == true){
                $request->file('logo')->storeAs($company->id.'/', $request->file('logo')->getClientOriginalName(), 'companies');
            }
        } else {
            $data['master_id'] = $master->id;
            $data['logo'] = $request->file('logo')->getClientOriginalName();
            $new = Company::create($data);
            if($request->hasFile('logo') == true) {
                $request->file('logo')->storeAs($new->id.'/', $request->file('logo')->getClientOriginalName(), 'companies');
            }
        }

        return redirect()->route('sentry.masters.index');
    }

    public function edit(Master $master)
    {
        $countries = Country::pluck('pai_nombre', 'id');
        return view('Sentry.masters.edit', compact('master', 'countries'));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function associate(Master $master)
    {
        $masters = Master::where('id', $master->id)->pluck('name', 'id');
        $suites = Suite::select('module_id')->where('master_id', $master->id)->get();
        $actives = [];
        foreach ($suites as $suite) {
            $actives[] = $suite->module_id;
        }
        $modules = Module::where('nivel', '!=', 1)->whereNotIn('id', $actives)->pluck('name', 'id');
        return view('Sentry.suites.create', compact('masters', 'modules'));
    }

    public function userCreate(Master $master)
    {
        return view('Sentry.masters.register', compact('master'));
    }

    public function userStore(Master $master, UsersRequest $request)
    {
        User::storageImage($request, "create");
        $data = $request->all();
        if($request->hasFile('photo') == true){
            $data['photo'] = $request->file('photo')->getClientOriginalName();
        }
        $user = User::create($data);
        return redirect()->route('sentry.masters.users.privileges', [Hashids::encode($master->id), Hashids::encode($user->id)]);
    }

    public function departamentStore(Master $master, DepartamentRequest $request)
    {
        Departament::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('sentry.masters.index');
    }

    public function userSetPrivileges(Master $master, User $user)
    {
        /*$actives = Suite::where('master_id', $master->id)->where('active', 1)->select('module_id')->get();
        $ids = array();
        foreach($actives as $active){
            $ids[] = $active->module_id;
        }
        $modules = Module::where('nivel', '!=', 1)->whereIn('id', $ids)->get();
        return view('Sentry.masters.privileges', compact('modules', 'master', 'user'));*/
        $clients = $user->current_master->clients;
        if($user->departament_id == 0) {
            $clients = array();
            $clients[] = $user->company;
        }

        if($user->departament_id > 0){
            $master_apps = Module::where('nivel', '=', 2)->get();
            return view('Sentry.masters.privileges')->with(['user' => $user, 'clients' => $clients, 'master_apps' => $master_apps, 'master' => $master]);
        }
        return view('Sentry.masters.privileges')->with(['user' => $user, 'clients' => $clients, 'master' => $master]);
    }

    public function userSavePrivileges(Master $master, User $user, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|min:1',
            'module_id' => 'required|integer|min:1',
            'type_id' => 'required|integer|min:1'
        ]);

        if($validator->fails()) {
            return response()->json([
                'heading' => 'Information',
                'message' => 'Error en la validación de los datos recibidos'
            ]);
        }

        $module_id = $request->get("module_id");
        $company_id = $request->get("company_id");
        $type_id = $request->get("type_id");

        $module = Module::find($module_id);
        $company = Company::find($company_id);
        $type = Type::find($type_id);

        if(count($user->privileges()->where('company_id', $company_id)->where('module_id', $module_id)->first()) == 0){
            $user->privileges()->attach($type, ['company_id' => $company_id, 'module_id' => $module_id, 'active' => 1]);
            return response()->json([
                "heading" => "Create",
                "message" => $user->fullname." es un usuario: ".$type->name." en la aplicación ".$module->name." exclusivamente para la empresa ".$company->name
            ]);
        } else {
            $object = $user->privileges()->where('company_id', $company_id)->where('module_id', $module_id)->first();
            \DB::table('users_companies_modules_types')->where('id', $object->pivot->id)->update(['type_id' => $type_id]);
            return response()->json([
                "heading" => "Update",
                "message" => $user->fullname." es un usuario: ".$type->name." en la aplicación ".$module->name." exclusivamente para la empresa ".$company->name
            ]);
        }

        /*if(count($user->modules()->where('module_id', $module)->first()) == 0) {
            $user->modules()->attach($module, ['type' => $type]);
            return response()->json(['message' => "Permiso establecido para {$user->name}"]);
        } else {
            $object = $user->modules()->where('module_id', $module)->first();
            $object->pivot->type = $type;
            $object->pivot->save();
            return response()->json(['message' => "Permiso actualizado para {$user->name}"]);
        }*/
    }
}
