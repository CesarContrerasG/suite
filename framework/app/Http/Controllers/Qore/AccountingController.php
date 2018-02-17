<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\Qore\AccountingRequest;
use App\Http\Controllers\Controller;
use App\Qore\Accounting;
use App\Helpers;
use Carbon\Carbon;

class AccountingController extends Controller
{
    public function index()
    {
        $previous_balance = Accounting::previousBalance();
        $records = Accounting::where(\DB::raw("MONTH(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), date('m'))
            ->where(\DB::raw("YEAR(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), date('Y'))->get();
        $subtotalIncome = Accounting::subtotalIncome($records);
        $subtotalExpenditures = Accounting::subtotalExpenditures($records);

        $dataset = Accounting::getChartDataset(6);
        $chartjs = Accounting::buildChart($dataset);

        return view('Qore.accounting.index', compact('chartjs', 'records', 'subtotalIncome', 'subtotalExpenditures', 'previous_balance'));
    }

    public function create()
    {
        $methods = Helpers::getListPaymentMethodsSAT();
        return view('Qore.accounting.create', compact('methods'));
    }

    public function store(AccountingRequest $request)
    {
        $data =  $request->all();
        $data = Accounting::formattedQuery($data, $request);
        $record = Accounting::create($data);
        Accounting::storageFile($request, $record);
        Session::flash('message', 'Nuevo registro guardado con exito');
        return redirect()->route('qore.accounting.index');
    }

    public function show(Accounting $record)
    {
        return view('Qore.accounting.show', compact('record'));
    }

    public function edit(Accounting $record)
    {
        $methods = Helpers::getListPaymentMethodsSAT();
        return view('Qore.accounting.edit', compact('record', 'methods'));
    }

    public function update(Accounting $record, AccountingRequest $request)
    {
        $data = $request->all();
        $data = Accounting::formattedQuery($data, $request);
        $record->fill($data);
        $record->save();
        Accounting::storageFile($request, $record);
        Session::flash('message', 'Información del registro actualizada con exito');
        return redirect()->route('qore.accounting.index');
    }

    public function destroy(Accounting $record, Request $request)
    {
        $record->delete();
        $record->restore();
        if($request->ajax())
        {
            return response()->json(['message' => "Borrado exitoso!!"]);
        }
        return redirect()->route('qore.contracts.index');
    }

    public function report()
    {
        $records = Accounting::where(\DB::raw("MONTH(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), date('m'))
            ->where(\DB::raw("YEAR(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), date('Y'))->get();
        $incomeIVA = Accounting::incomeIVA($records);
        $expendituresIVA = Accounting::expendituresIVA($records);
        $subtotalIncome = Accounting::subtotalIncome($records);
        $subtotalExpenditures = Accounting::subtotalExpenditures($records);
        $total = $subtotalIncome - $subtotalExpenditures;
        return view('Qore.accounting.report', compact('records', 'incomeIVA', 'expendituresIVA', 'subtotalIncome', 'subtotalExpenditures', 'total'));
    }
}
