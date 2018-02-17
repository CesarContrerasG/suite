<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\CoveRequest;
use App\Cove\Cove;
use App\Cove\Invoice;
use App\Qore\Company;
use App\Cove\Material;
use App\Cove\Inventory;
use App\Cove\Seal;
use App\Cove\Provider;
use App\Cove\Customer;
use App\Cove\Digital;
use App\Cove\Detail;

class CoveController extends Controller
{
    public function index()
    {
        $coves = Cove::all();
        
        return view('Cove.administration.index')->with(['coves' => $coves]);
    }

    public function create()
    {
        return view('Cove.administration.create');        
    }

    public function store(CoveRequest $request)
    {
        $cove = new Cove;
        Cove::insertOrUpdate($cove, $request);

        return redirect()->route('cove.edit', [$cove->pk_item]);
    }

    public function edit(Cove $cove, CoveRequest $request)
    {
        $id_company = session()->get('company');
        $invoices = $cove->invoices()->paginate(5);
        $receiver = '';
        $transmitter = '';
        $list_invoice = $cove->invoices()->pluck('inv_factura', 'inv_factura');
        $parts = Invoice::all_parts();
        $inventory = $cove->inventory()->paginate(5);
        $total_inventory = $cove->inventory()->sum('inv_valortotal');
        if($cove->pk_tipo == 2)
            $transmitter = Company::find($id_company);
        else
            $receiver = Company::find($id_company);
        $company = Company::where('id', $id_company)->pluck('business_name','name')->prepend('Selecciona...');
        $customer = Customer::pluck('cli_razon','pk_cli')->prepend('Selecciona...');
        $provider = Provider::pluck('pro_razon','pk_pro')->prepend('Selecciona...');
       
        
        return view('Cove.administration.edit')->with(['cove' => $cove, 'invoices' => $invoices, 'receiver' => $receiver, 'transmitter' => $transmitter, 'company' => $company, 'customer' => $customer, 'provider' => $provider, 'list_invoice' => $list_invoice, 'parts' => $parts, 'inventory' => $inventory, 'total' => $total_inventory]);
    }    

    public function update(Cove $cove, CoveRequest $request)
    {
        Cove::insertOrUpdate($cove, $request);

        return redirect()->route('cove.administration.index');
    }

    public function show(Cove $cove)
    {
        $view =  view('Cove.administration.view', compact('cove'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('invoice');
    }
    
    public function destroy(Cove $cove)
    {
        Invoice::where('pk_item', $cove->pk_item)->delete();
        $inventory = Inventory::where('inv_item', $cove->pk_item)->get();
        foreach ($inventory as $inv) {
            Detail::where('inv_item', $inv->pk_item)->delete();
        }
        Inventory::where('inv_item', $cove->pk_item)->delete();
        $cove->delete();

        return response()->json(['redirect' => 'administration']);
    }

    public function sign($id, $type)
    {
        $cove = Cove::find($id);
        $seal = Seal::first();
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        $path = storage_path('xml') . '/cove/';
        $NoOperacion = ''; 
        $id_acuse = '';
        if($company->sector == 3)
            $automotriz = 1;
        else
            $automotriz = 0;

        if(!is_null($seal))
        {
            // Crear cadena original
            $xml_cadena = Cove::createXML($seal, $cove, 1, $automotriz, $path, $company->name); 
            Cove::createString($xml_cadena, $cove, $seal, $path);
            // Crear xml con informacion del COVE
            $xml_consulta = Cove::createXML($seal, $cove, 2, $automotriz, $path, $company->name); 
            if(file_exists($xml_consulta))
            {
                $NoOperacion = Cove::responseOperation($cove, $xml_consulta, $type, $automotriz, $path, $company->name);   
                if($NoOperacion != '')
                {
                    $result = Cove::response($NoOperacion, $seal, $cove, $path, $company->name);
                    if($result['error'] == 0)
                    	$id_acuse = Cove::createAcuse($id, $seal, $company->name);
                }
                else{
                    $result = 'No se creo un numero de operación';
                }
            }
            else
            {
                $result = 'No se creo xml de consulta';
            }
        }
        else
        {
            $result = 'Sellos no registrados';
        }

        return view('Cove.administration.result')->with(['result' => $result, 'operation' => $NoOperacion, 'id' => $id, 'acuse' => $id_acuse]);

    }

    public function download(Cove $cove)
    {
        $seal = Seal::first();
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        if($company->sector == 3)
            $automotriz = 1;
        else
            $automotriz = 0;
        $path = storage_path('xml') . '/cove/';  
        $file = storage_path('xml/cove/'.$company->name.'/request_cove_' . $cove->pk_item . '.xml');

        if(!file_exists($file)) 
            $file = Cove::createXML($seal, $cove, 2, $automotriz, $path, $company->name);

        if(file_exists($file)) 
            return response()->download($file);

        return redirect()->back();
    }

    public function acuse($acuse)
    {
    	$id_company = session()->get('company');
    	$company = Company::find($id_company);
    	$document = Digital::find($acuse);
    	$path =  storage_path().'/modules/cove/'.$company->name.'/'.$document->pk_referencia;  
    	$file = $path.'/'.$document->imgNameFile;

    	return response()->download($file);
    }

}