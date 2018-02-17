<?php

namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests\Cove\SealRequest;
use App\Http\Controllers\Controller;
use App\Cove\Seal;
use App\Qore\Aduana;


class SealController extends Controller
{

	public function index()
	{     
        $seal = Seal::first();
        $aduanas = Aduana::selectRaw('CONCAT(adu_numero,adu_seccion,"|",adu_denomina) as name, CONCAT_WS("", adu_numero, adu_seccion) as id')->pluck('name','id');
        $type = auth()->user()->permission_recove;

		return view('Recove.seals')->with(['seal' => $seal, 'aduanas' => $aduanas, 'type' => $type]);
	}
    
    public function store(SealRequest $request)
    {        
        $result = Seal::data($request);
        Seal::insert($result);
        	    
       	return redirect()->route('recove.seals.index');       
    }

    public function update(Seal $seal, Request $request)
    {        
        $seal->sello_wsp = $request->sello_wsp;
        $seal->save();

    	return redirect()->route('recove.seals.index');  
    }

    public function destroy(Seal $seal)
    {  
    	$seal->delete();

    	return response()->json(['redirect' => 'seals']);
    }
}