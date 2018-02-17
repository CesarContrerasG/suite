<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Qore\ContractRequest;
use App\Qore\Contract;
use App\Qore\Details;
use App\Qore\Dates;
use App\Qore\Company;
use App\Qore\Cycles;

class ContractsController extends Controller
{
    public function index()
    {
        $contracts = \Auth::user()->departament->company->master->contracts;
        return view('Qore.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $clients = \Auth::user()->departament->company->master->contrators->pluck('name', 'id');
        $cycles = Cycles::pluck('concept', 'id');
        $products = \Auth::user()->departament->company->master->products;
        return view('Qore.contracts.create', compact('clients', 'cycles', 'products'));
    }

    public function store(ContractRequest $request)
    {
        Contract::saveContract($request);
        return redirect()->route('qore.contracts.index');
    }

    public function edit(Contract $contract)
    {
        $clients = \Auth::user()->departament->company->master->clients->pluck('name', 'id');
        $cycles = Cycles::pluck('concept', 'id');
        return view('Qore.contracts.edit', compact('clients', 'cycles', 'contract'));
    }

    public function update(Contract $contract, ContractRequest $request)
    {
        Contract::updateContract($contract, $request);
        return redirect()->route('qore.contracts.index');
    }

    public function destroy(Contract $contract, Request $request)
    {
        $contract->delete();
        $contract->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        return redirect()->route('qore.contracts.index');
    }
}
