<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Requests\Setup\ModuleRequest;
use App\Http\Controllers\Controller;
use App\Sentry\Module;
use App\Sentry\Security;

class ModulesController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        $nivels = Security::nivelsModules();
        return view('Sentry.modules.index', compact('modules', 'nivels'));
    }

    public function store(ModuleRequest $request)
    {
        $data = $request->all();
        $data['logo'] = $request->file('logo')->getClientOriginalName();
        Module::create($data);
        Module::storageImage($request);
        Session::flash('message', 'Nuevo módulo registrado');
        return redirect()->route('sentry.modules.index');
    }

    public function edit(Module $module)
    {
        return response()->json(['module' => $module]);
    }

    public function update(Module $module, ModuleRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('logo')){
            $data['logo'] = $request->file('logo')->getClientOriginalName();
        }
        $module->fill($data);
        $module->save();
        Module::storageImage($request);
        Session::flash('message', 'Módulo actualizado exitosamente!!');
        return redirect()->route('sentry.modules.index');
    }

    public function destroy(Module $module, Request $request)
    {
        $module->delete();
        $module->restore();
        Session::flash('message', 'Módulo eliminado exitosamente!!');
        return redirect()->route('sentry.modules.index');
    }

}
