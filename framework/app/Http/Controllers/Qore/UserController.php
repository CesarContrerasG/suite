<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Requests\Qore\UsersRequest;
use App\Http\Requests\Qore\UpdateUsersRequest;
use App\Http\Controllers\Controller;
use App\Sentry\Suite;
use App\Sentry\Module;
use App\Qore\Departament;
use App\User;

use Validator;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::where('master_id', auth()->user()->master_id)->get();
        return view('Qore.users.index')->with('users',$users);
    }

    public function create()
    {
        $departaments = \Auth::user()->departament->company->departaments->pluck('name', 'id');
        return view('Qore.users.create', compact('departaments'));
    }

    public function store(UsersRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('photo') == true)
        {
            $data['photo'] = $request->file('photo')->getClientOriginalName();
        }
        $user = User::create($data);
        User::storageImage($request, $user);
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.users.index');
    }

    public function edit(User $user)
    {
        $departaments = \Auth::user()->departament->company->departaments->pluck('name', 'id');
        return view('Qore.users.edit', compact('user', 'departaments'));
    }

    public function update(User $user, UpdateUsersRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('photo') == true)
        {
            $data['photo'] = $request->file('photo')->getClientOriginalName();
        }
        $user->fill($data);
        $user->save();
        User::storageImage($request, $user);
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.users.index');
    }

    public function destroy(User $user)
    {
    	$user->delete();
        $user->restore();
    	return response()->json(['redirect' => 'users']);
    }

    public function disabled(User $user)
    {
    	User::toggleStatus($user);
    	return redirect()->back();
    }

    public function permissions(User $user)
    {
        $actives = Suite::where('master_id', auth()->user()->master_id)->where('active', 1)->select('module_id')->get();
        $modules = Module::where('nivel', '!=', 1)->whereIn('id', $actives)->get();
        
        if($user->departament_id == 0)
        {
            $modules = Module::where('nivel', '!=', 1)->where('nivel', '!=', 2)->whereIn('id', $actives)->get();
        }
        
        return view('Qore.users.permissions', compact('user', 'modules'));
    }

    public function privileges(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        }
    }

    public function createClient()
    {
        $clients = auth()->user()->clientsPluck();
        return view('Qore.users.clients.create', compact('clients'));
    }

    public function editClient(User $user)
    {
        $clients = $user->clientsPluck();
        return view('Qore.users.clients.edit', compact('user', 'clients'));
    }
}
