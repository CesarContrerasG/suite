<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Http\Requests\Qore\CompanyRequest;

use App\Qore\Company;
use App\Qore\Country;
use App\Sentry\Master;

class CompanyController extends Controller
{
    public function index()
    {
    	$companies = \Auth::user()->current_master->clients;
        return view('Qore.companies.index')->with('companies',$companies);
    }

    public function create()
    {
        $countries = Country::pluck('pai_nombre', 'pai_clavem3');
        return view('Qore.companies.create', compact('countries'));
    }

    public function store(CompanyRequest $request)
    {
        $registered = $request->get('registered');
        $rfc = $request->get('rfc');
        $type = $request->get('type');
        $company = Company::where('rfc', $rfc)->first();
        $master = Master::find(\Auth::user()->current_master->id);

        if($registered == 1 && count($company) > 0)
        {
            $master->companies()->attach($company->id, ['type' => $type]);
        }
        else
        {
            $data = $request->all();
            if($request->hasFile('logo'))
            {
                $data['logo'] = $request->file('logo')->getClientOriginalName();
            }
            $new = Company::create($data);
            if($request->hasFile('logo'))
                $request->file('logo')->storeAs($new->id.'/', $request->file('logo')->getClientOriginalName(), 'companies');
            $master->companies()->attach($new->id, ['type' => $type]);
        }
        Session::flash('message', 'Cliente registrado');
        return redirect()->route('qore.companies.index');
    }

    public function edit(Company $company)
    {
        $countries = Country::pluck('pai_nombre', 'pai_clavem3');
        return view('Qore.companies.edit', compact('company', 'countries'));
    }

    public function update(Company $company, CompanyRequest $request)
    {
        $data = $request->all();
        
        if($request->hasFile('logo')){
            $data['logo'] = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs($company->id.'/', $request->file('logo')->getClientOriginalName(), 'companies');
        }

        $company->fill($data);
        $company->save();
        Session::flash('message', 'Cliente editado');
        return redirect()->route('qore.companies.index');
    }

    public function destroy(Company $company)
    {
        $master = \Auth::user()->current_master;
        $master->companies()->updateExistingPivot($company->id, ['deleted' => date('Y-m-d')]);
    	//$company->delete();
        //$company->restore();
    	return response()->json(['redirect' => 'companies']);
    }

    public function disabled(Company $company)
    {
    	Company::toggleStatus($company);
    	return redirect()->back();
    }
}
