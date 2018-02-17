<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Requests\Setup\SuiteRequest;
use App\Http\Controllers\Controller;
use App\Sentry\Master;
use App\Sentry\Module;
use App\Sentry\Suite;

class SuitesController extends Controller
{
    public function create()
    {
        $masters = Master::pluck('name', 'id');
        $modules = Module::where('nivel', '!=', 1)->pluck('name', 'id');
        return view('Sentry.suites.create', compact('masters', 'modules'));
    }

    public function store(SuiteRequest $request)
    {
        $suite = Suite::create($request->all());
        $master = Master::find($request->get('master_id'));
        Session::flash('message', 'Aplicación asociada a '.$master->name);
        return redirect()->route('sentry.masters.index');
    }

    public function toggle(Suite $suite)
    {
        if($suite->active == 1){
            $suite->active = 0;
            $suite->save();
            $suite->lockOrRegister();
        }else{
            $suite->active = 1;
            $suite->save();
            $suite->activeOrRegister();
        }
        return response()->json(['message' => 'Suite state, changed !!']);
    }

    public function destroy(Suite $suite, Requests $request)
    {
        $suite->delete();
        $suite->restore();
        Session::flash('message', 'Aplicación desasociada correctamente');
        return redirect()->route('sentry.masters.index');
    }
}
