<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Qore\CompanyRequest;
use App\Qore\Company;
use App\Cove\Seal;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::find(session()->get('company'));
        $seal = Seal::first();
        $type = auth()->user()->permission_cove;

        return view('Cove.company.index')->with(['company' => $company, 'seal' => $seal, 'type' => $type]);
    }

    public function update(Company $company, CompanyRequest $request)
    {        
        $company->business_name = $request->business_name;
        $company->rfc = $request->rfc;
        $company->address = $request->address;
        $company->outdoor = $request->outdoor;
        $company->interior = $request->interior;
        $company->colony = $request->colony;
        $company->location = $request->location;
        $company->town = $request->town;
        $company->station = $request->station;
        $company->country = $request->country;
        $company->save();
    }

}