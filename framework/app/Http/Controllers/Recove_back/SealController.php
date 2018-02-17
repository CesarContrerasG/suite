<?php

namespace App\Http\Controllers\Recove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Recove\SealRequest;
use App\Http\Controllers\Controller;
use App\Recove\Seal;
use App\Qore\Aduana;


class SealController extends Controller
{

	public function index()
	{
     
        $seal = Seal::first();
        $aduanas = Aduana::select(\DB::raw('CONCAT(adu_numero,adu_seccion,"|",adu_denomina) as name'),\DB::raw('CONCAT(adu_numero,adu_seccion) as id'))->pluck('name','id');

		return view('Recove.seals')->with(['seal' => $seal,'aduanas' => $aduanas]);
	}

    public function store(SealRequest $request)
    {
        
        $result = Seal::openKey($request);

        if($result != null)
        {
        	Seal::create($result);  
        	return redirect()->route('recove');
        }
	    
       	return redirect()->route('recove.seals.index');       
    }

    public function update(Seal $seal, SealRequest $request)
    {
    	$seal->where('pk_item',$seal->pk_item)->update(['sello_wsp' => $request->input('sello_wsp')]);

    	return redirect()->route('recove');
    }

    public function destroy(Seal $seal)
    {
    	$seal->where('pk_item',$seal->pk_item)->delete();

    	return redirect()->route('recove');
    }
}