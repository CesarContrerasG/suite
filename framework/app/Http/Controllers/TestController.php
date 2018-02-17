<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qore\Contract;
use App\Qore\Product;
use App\Sentry\Configuration;
use App\Sentry\Suite;

class TestController extends Controller
{
    public function upload()
    {
        //return view('tests.storage');
    }

    public function storage(Request $request)
    {
        /*
        $master = \Auth::user()->current_master->rfc;
        $year = date('Y', strtotime($request->get('register_date')));
        $month = date('m', strtotime($request->get('register_date')));
        $path = $master.'/'.$year.'/'.$month.'/tests';
        $request->file('file-upload')->store($path, 'qore');

        return redirect()->route('test.upload');
        */

    }

    public function template()
    {
        //return view('tests.template_mail');
    }

    public function dbContract($id)
    {
        /*
        $contract = Contract::find($id);
        $configuration = Configuration::where('master_id', $contract->master_id)->first();

        if($contract->needDatabase())
        {
            Configuration::createDB($contract, $configuration);
        }
        */
    }

    public function executeScript($id)
    {
        //$contract = Contract::find($id);
        //return dd($contract->executeScripts());

    }

    public function testSuite(Suite $suite)
    {
        //return $suite->activateOrRegister();
        //return $suite->lockOrRegister();
    }

    public function generateInvoice()
    {
        $contracts = Contract::all();

        foreach ($contracts as $contract) {
            $detail = $contract->details->first();
            $days = $contract->dates->credit_days;
            $date = date("Y-m-d", strtotime($detail->billing_date." + ".$days." days"));

            if($date >= date("Y-m-d")){
                echo "Se registrara una factura automaticamente para el contrato con indice: {$contract->id} / fecha de facturación {$date} dias de credito incluidos<br>";
            }
        }
    }
}
