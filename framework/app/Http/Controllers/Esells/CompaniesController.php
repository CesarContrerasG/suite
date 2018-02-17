<?php

namespace App\Http\Controllers\Esells;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Qore\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = auth()->user()->current_master->clients;
        return view('esells.companies.index', compact('companies')); 
    }
}
