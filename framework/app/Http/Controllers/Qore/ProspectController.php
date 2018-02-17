<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Qore\CompanyRequest;

use App\Qore\Company;
use App\Qore\Country;
use App\Setup\Master;

class ProspectController extends Controller
{
    public function index()
    {
    	$prospects = \Auth::user()->current_master->prospects;
        return view('Qore.prospects.index')->with('prospects', $prospects);
    }

    public function create()
    {
        $countries = Country::pluck('pai_nombre', 'pai_clavem3');
        return view('Qore.prospects.create', compact('countries'));
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
            $new = Company::create($request->all());
            $master->companies()->attach($new->id, ['type' => $type]);
        }
        Session::flash('message', 'Prospecto registrado');
        return redirect()->route('qore.prospects.index');
    }

    public function edit(Company $company)
    {
        $countries = Country::pluck('pai_nombre', 'pai_clavem3');
        return view('Qore.prospects.edit', compact('company', 'countries'));
    }

    public function update(Company $company, CompanyRequest $request)
    {
        $company->fill($request->all());
        $company->save();
        Session::flash('message', 'Prospecto editado');
        return redirect()->route('qore.prospects.index');
    }

    public function destroy(Company $company)
    {
        $master = \Auth::user()->current_master;
        $master->companies()->updateExistingPivot($company->id, ['deleted' => date('Y-m-d')]);
    	//$company->delete();
        //$company->restore();
    	return response()->json(['redirect' => 'prospects']);
    }

    public function disabled(Company $company)
    {
    	Company::toggleStatus($company);
    	return redirect()->back();
    }
}
