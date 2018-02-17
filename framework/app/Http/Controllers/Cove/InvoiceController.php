<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\InvoiceRequest;
use App\Cove\Invoice;
use App\Qore\Company;
use App\Cove\Provider;
use App\Cove\Material;
use App\Cove\Product;
use App\Cove\Asset;
use App\Cove\Cove;

class InvoiceController extends Controller
{
    public function store(InvoiceRequest $request)
    {        
        Invoice::insertOrUpdate($request);

        return redirect()->back();
    }

    public function show(Invoice $invoice)
    {

        return response()->json(['invoice' => $invoice]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(['redirect' => 'edit']);
    }

    public function transmitter(Request $request)
    {
        if($request->type == 2)
            $transmitter = Company::where('name', $request->emisor)->first();
        else
            $transmitter = Provider::where('pk_pro', $request->emisor)->first();
        
        return response()->json(['transmitter' => $transmitter]);

    }

    public function receiver(Request $request)
    {
        if($request->type == 1)
            $receiver = Company::where('name', $request->destina)->first();
        else
            $receiver = Customer::where('pk_cli', $request->destina)->first();
        
        return response()->json(['receiver' => $receiver]);

    }

    public function description(Request $request)
    {
        $materials = Material::select('pk_mat', 'mat_descove as descove')->where('pk_mat', $request->parte);
        $products = Product::select('pk_prod',  'prod_descove as descove')->where('pk_prod', $request->parte);
        $assets = Asset::select('pk_af',  'af_descove as descove')->where('pk_af', $request->parte);
        $parts = $materials->union($products)->union($assets)->first();

        return response()->json($parts);
    }

    public function view(Cove $cove, $type)
    {
   
        if($type == 1)            
            $view =  view('Cove.administration.invoice_MX', compact('cove'))->render();
        else
            $view =  view('Cove.administration.invoice_USA', compact('cove'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('invoice');
    }
}