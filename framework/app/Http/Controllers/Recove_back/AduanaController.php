<?php

namespace App\Http\Controllers\Recove;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AduanaController extends Controller
{
	public function store()
	{
		dd(Input::all());
	}

}