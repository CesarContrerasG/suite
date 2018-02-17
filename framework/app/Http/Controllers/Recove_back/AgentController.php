<?php

namespace App\Http\Controllers\Recove;

use App\Http\Controllers\Controller;
use App\Recove\Agent;
use App\ConnectionDB;
use Illuminate\Support\Facades\Input;

class AgentController extends Controller
{
	public function index()
	{
		$agents =  Agent::paginate(10);

		return view('Recove.agents')->with('agents',$agents);
	}

	public function store()
	{
		$emp = ConnectionDB::changeConnection();
        $file =  Input::file("file")->getClientOriginalName();
        $path = public_path().'/apps/recove/';
        Input::file("file")->move($path,$file);
        $fh = fopen($path.$file, "r");      
      
        while ($data = fgetcsv ( $fh)) {   
           
	        $datos = [
	            'pk_age' => trim($data[0]),
	            'pk_emp' => $emp,
	            'age_razon' => trim($data[2]),
	            'age_rfc'   => trim($data[1])                  
	        ];
	        Agent::insert($datos);             
       	}
        fclose($fh); 
      	
      	return redirect()->back(); 
	}

}