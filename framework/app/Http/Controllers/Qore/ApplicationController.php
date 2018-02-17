<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Sentry\Suite;
use App\Sentry\Module;
use App\Sentry\Type;
use App\Qore\Company;

use App\User;

use Validator;

class ApplicationController extends Controller
{
    public function index(){
        return view('Qore.applications.index');
    }

    public function associate()
    {
        $clients = auth()->user()->current_master->clients;
        $actives = Suite::where('master_id', auth()->user()->master_id)->where('active', 1)->select('module_id')->get();
        $modules = Module::where('nivel', '!=', 1)->where('nivel', '!=', 2)->whereIn('id', $actives)->get();

        return view('Qore.applications.companies.associate', compact('clients', 'modules'));
    }

    public function active(Company $company, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'module_id' => 'required|integer|min:1'
        ]); 

        if($validator->fails()){
            return response()->json(['message', 'Error en la validación de los datos recibidos']);
        }

        $module = $request->get("module_id");

        if(count($company->modules()->where('module_id', $module)->first()) == 0) {
            $company->modules()->attach($module, ['active' => 1]);
            return response()->json(['message' => 'Acceso de la aplicación establecido a la empresa']);
        } else {
            $object = $company->modules()->where('module_id', $module)->first();
            if($object->pivot->active == 1){
                $object->pivot->active = 0;
                $object->pivot->save();
                return response()->json(["message" => "Aplicación desactivada para la empresa ".$company->name]);
            } else {
                $object->pivot->active = 1;
                $object->pivot->save();
                return response()->json(["message" => "Aplicación activada para la empresa ".$company->name]);
            }
        }
    }

    public function applicationsUsers(User $user)
    {
        $clients =  $user->current_master->clients;
        if($user->departament_id > 0){
            $master_apps = Module::where('nivel', '=', 2)->get();
            return view('Qore.applications.users.associate')->with(['user' => $user, 'clients' => $clients, 'master_apps' => $master_apps]);
        }
        return view('Qore.applications.users.associate')->with(['user' => $user, 'clients' => $clients]);
    }

    public function applicationsPermissions(User $user, Request $request)
    {
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
}
