<?php

use App\Qore\Product;
use App\Qore\Company;
use App\Qore\Departament;
use App\Qore\Prospect;
use App\User;

	function totales()
	{
		$num_systems 		= count(\Auth::user()->departament->company->master->products);
	    $num_clients 		= count(\Auth::user()->departament->company->master->clients);
	    $num_providers 		= count(\Auth::user()->departament->company->master->providers);
		$num_departaments 	= count(\Auth::user()->departament->company->departaments);
	    $num_prospects 		= count(\Auth::user()->departament->company->master->prospects);
	    $num_users 			= count(\Auth::user()->departament->company->users);

	    $data = [
	    	'products' => $num_systems,
	    	'clients' => $num_clients,
	    	'providers' => $num_providers,
			'departaments' => $num_departaments,
	    	'prospects' => $num_prospects,
	    	'users' => $num_users
	    ];

	    return $data;
	}

	function dataForStorage($date)
	{
		$data = array();

		$data['year'] = date('Y', strtotime($date));
		$data['month'] = date('m', strtotime($date));
		$data['master'] = auth()->user()->current_master->rfc;

		return $data;
 	}
