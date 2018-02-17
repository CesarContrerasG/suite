<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Anexo31\DischargeRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Anexo31\Discharge;
use App\Qore\DestinationA31;

class DischargeController extends Controller
{
    public function index()
    {
    	return view('Anexo31.discharge.index');	
    }

    public function store(DischargeRequest $request)
    {
        $result = Discharge::insertData($request->file('file'), $request->get('folio'));  
        if($result == false)
            return redirect()->back()->with('error','Ya existe un reporte de descargo para este periodo o no existe DS de este periodo');

        return redirect()->back();
    }

    public function check()
    {
        $destination = DestinationA31::all();
        $discharge = Discharge::where('anio', Input::get('year'))->where('periodo_id', Input::get('period'))->where('status', 1)->get();        

        return response()->json(['discharge' => $discharge, 'destination' => $destination]);
    }
}