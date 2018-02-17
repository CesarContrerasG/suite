<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Cove\SealRequest;
use App\Http\Controllers\Controller;
use App\Cove\Seal;
use App\Qore\Aduana;


class SealController extends Controller
{

    public function store(SealRequest $request)
    {        
        $result = Seal::data($request);
        Seal::insert($result);
	    
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