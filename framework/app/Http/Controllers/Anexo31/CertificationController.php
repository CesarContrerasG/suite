<?php

namespace App\Http\Controllers\Anexo31;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Anexo31\CertificationRequest;
use App\Qore\Company;

class CertificationController extends Controller
{
    public function index()
    {
        $id = \Auth::user()->departament->company->id;
        $company = Company::find($id);
        $certification = $company->certifications()->wherePivot('company_id', $id)->get();

    	return view('Anexo31.certification.index')->with(['company' => $company, 'certification' => $certification]);	
    }

    public function update($id, CertificationRequest $request)
    {
        $id_company = \Auth::user()->departament->company->id;
        $company = Company::find($id_company);
        $company->certifications()->updateExistingPivot($id,['date_cert' => $request->get('date_cert')], false);

    	return redirect()->back();
    }

    public function store(CertificationRequest $request)
    {
        $id = \Auth::user()->departament->company->id;
        $company = Company::find($id);
        $company->certifications()->attach($company->id, ['company_id' => $id, 'certification_id' => 1, 'date_cert' => $request->get('date_cert')]);   
        
        return redirect()->back();
    }
}