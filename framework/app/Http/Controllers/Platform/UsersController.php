<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Qore\UsersRequest;
use App\Http\Requests\Qore\UpdateUsersRequest;

use App\Sentry\Suite;
use App\Sentry\Module;
use App\Sentry\Configuration;
use App\Sentry\Type;
use App\Qore\Company;
use App\Helpers;
use App\User;
use App\Activity;

use Validator;

class UsersController extends Controller
{

    public function indexUsers()
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $configuration = Configuration::where('master_id', auth()->user()->master_id)->first();

        if($company_id = auth()->user()->company_id == auth()->user()->master_id) {
            $users = User::where('master_id', auth()->user()->master_id)->get();
        } else {
            $users = User::where('company_id', $company_id = auth()->user()->company_id)->get();
        }

        return view('Platform.users.index', compact('users', 'configuration'));
    }

    public function createUser()
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $master_id = auth()->user()->master_id;
        $configuration = Configuration::where('master_id', $master_id)->first();
        $departaments = [];

        $master = false;
        if(auth()->user()->master_id == auth()->user()->company_id){
            $master = true;
            $departaments = \Auth::user()->departament->company->departaments->pluck('name', 'id');
            return view('Platform.users.create', compact('configuration', 'master', 'departaments'));
        }

        return view('Platform.users.create', compact('configuration', 'master'));
    }

    public function storeUser(UsersRequest $request)
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $data = $request->all();
        $data['photo'] = $request->file('photo')->getClientOriginalName();
        $user = User::create($data);
        User::storageImage($request, $user);
        return redirect()->route('platform.users.index');
    }

    public function createClient()
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $master_id = auth()->user()->master_id;
        $configuration = Configuration::where('master_id', $master_id)->first();
        $departaments = [];

        if(auth()->user()->master_id == auth()->user()->company_id){
            $clients = auth()->user()->clientsPluck();
            return view('Platform.users.client', compact('configuration', 'clients'));
        }
        return redirect()->back();
    }

    public function editUser(User $user)
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $master_id = auth()->user()->master_id;
        $configuration = Configuration::where('master_id', $master_id)->first();
        $master = false;

        if($user->departament_id > 0) {
            $master = true;
            $departaments = \Auth::user()->departament->company->departaments->pluck('name', 'id');
            return view('Platform.users.edit', compact('user', 'departaments', 'master', 'configuration'));
        }
        $clients = auth()->user()->clientsPluck();
        return view('Platform.users.edit', compact('user', 'clients', 'master', 'configuration'));
    }

    public function updateUser(User $user, UpdateUsersRequest $request)
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $data = $request->all();
        if($request->hasFile('photo') == true)
        {
            $data['photo'] = $request->file('photo')->getClientOriginalName();
        }
        $user->fill($data);
        $user->save();
        User::storageImage($request, $user);
        return redirect()->route('platform.users.index');
    }

    public function destroyUser(User $user, Request $request)
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $user->delete();
        $user->restore();
        if($request->ajax())
        {
            return response()->json(["message" => "Borrado exitoso!!"]);
        }
        return redirect()->route('platform.users.index');
    }

    public function userPermissions(User $user)
    {
        if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        /*$master_id = auth()->user()->master_id;
        $configuration = Configuration::where('master_id', $master_id)->first();

        $actives = Suite::where('master_id', $master_id)->where('active', 1)->select('module_id')->get();
        $modules = Module::where('nivel', '!=', 1)->whereIn('id', $actives)->get();

        if($user->departament_id == 0)
        {
            $modules = Module::where('nivel', '!=', 1)->where('nivel', '!=', 2)->whereIn('id', $actives)->get();
        }*/

        //return view('Platform.users.permissions', compact('user', 'configuration', 'modules'))

        $clients = $user->current_master->clients;
        if($user->departament_id == 0) {
            $clients = array();
            $clients[] = $user->company;
        }

        if($user->departament_id > 0){
            $master_apps = Module::where('nivel', '=', 2)->get();
            return view('Qore.applications.users.associate')->with(['user' => $user, 'clients' => $clients, 'master_apps' => $master_apps]);
        }
        return view('Platform.users.applications')->with(['user' => $user, 'clients' => $clients]);
    }

    public function userPrivileges(User $user, Request $request)
    {
        /*if(auth()->user()->have_any_admin == false)
        {
            Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }*/

        /*$validator = Validator::make($request->all(), [
            'module_id' => 'required|integer|min:1',
            'type_id' => 'required|integer|min:1'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de los datos recibidos']);
        }

        $module = $request->get("module_id");
        $type = $request->get("type_id");

        if(count($user->modules()->where('module_id', $module)->first()) == 0) {
            $user->modules()->attach($module, ['type' => $type]);
            return response()->json(['message' => "Permiso establecido para {$user->name}"]);
        } else {
            $object = $user->modules()->where('module_id', $module)->first();
            $object->pivot->type = $type;
            $object->pivot->save();
            return response()->json(['message' => "Permiso actualizado para {$user->name}"]);
        }*/

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|min:1',
            'module_id' => 'required|integer|min:1',
            'type_id' => 'required|integer|min:1'
        ]);

        if($validator->fails()){
            return response()->json([
                "heading" => "Information",
                "message" => "Error en la validación de los datos recibidos"
            ]);
        }

        $module_id = $request->get('module_id');
        $company_id = $request->get('company_id');
        $type_id = $request->get('type_id');

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
    }

    public function profile()
    {
        $chartjs = Activity::chartUserActivities(auth()->user());
        $configuration = Configuration::where('master_id', auth()->user()->master_id)->first();

        return view('Platform.profile.index', compact('configuration', 'chartjs'));
    }

}
