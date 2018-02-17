<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Qore\DepartamentRequest;
use App\Qore\Departament;

class DepartamentsController extends Controller
{
    public function index()
    {
        $departaments = \Auth::user()->departament->company->departaments;
        return view('Qore.departaments.index', compact('departaments'));
    }

    public function create()
    {
        return view('Qore.departaments.create');
    }

    public function store(DepartamentRequest $request)
    {
        Departament::create($request->all());
        Session::flash('message', 'Registro exitoso!!');
        return redirect()->route('qore.departaments.index');
    }

    public function edit(Departament $departament)
    {
        return view('Qore.departaments.edit', compact('departament'));
    }

    public function update(Departament $departament, DepartamentRequest $request)
    {
        $departament->fill($request->all());
        $departament->save();
        Session::flash('message', 'Edición exitosa!!');
        return redirect()->route('qore.departaments.index');
    }

    public function destroy(Departament $departament)
    {
        $departament->delete();
        $departament->restore();
        return response()->json(['redirect' => 'departaments']);
    }

    public function disabled(Departament $departament)
    {
        Departament::toggleStatus($departament);
        return redirect()->route('qore.departaments.index');
    }
}
