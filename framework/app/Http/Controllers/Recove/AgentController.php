<?php

namespace App\Http\Controllers\Recove;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cove\Patent;

class AgentController extends Controller
{
	public function index()
	{
		$agents =  Patent::paginate(10);
		 $type = auth()->user()->permission_recove;

		return view('Recove.agents')->with(['agents' => $agents, 'type' => $type]);
	}

	public function store(Request $request)
	{
		$company = session()->get('company');
		$company_name = auth()->user()->company_name;    
        $name =  $request->file("file")->getClientOriginalName();
        $path = storage_path().'/companies/'.$company;
        $request->file("file")->move($path, $name);
        $fh = fopen($path.'/'. $name, "r");    
        $firstline = true;
        while ($data = fgetcsv ( $fh)) 
		{          
			if (!$firstline) 
			{
				$exist = Patent::where('pk_age', trim($data[0]))->first();
				if(is_null($exist))
					$agent = new Patent;
				else
					$agent = Patent::find($exist->pk_item);

		        $agent->pk_age = trim($data[0]);
		        $agent->pk_emp = $company_name;
		    	$agent->age_razon = utf8_encode(trim($data[2]));
		        $agent->age_rfc = trim($data[1]);
				$agent->save();				
			}
			$firstline = false;
	                  
       	}
        fclose($fh); 
      	
      	return redirect()->back(); 
	}

}