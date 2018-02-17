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
use App\Recove\Pedimento;
use Yajra\Datatables\Datatables;

class CoveController extends Controller
{
    public function index()
    {
        $id_company = session()->get('company');
        $type = 7;
        $type = auth()->user()->privileges()->wherePivot('company_id', $id_company)->wherePivot('module_id', 4)->first()->id;   
       
        return view('Cove.administration.index')->with('type', $type);
    }

    public function getCoves()
    {
        $coves = Cove::select('pk_item', 'pk_referencia','cove_factura','cove_edocument','cove_fecha', 'cove_numadenda', 'cove_patente','pk_tipo','cove_relacion', 'errores', 'cove_status')->orderby('cove_status', 'DESC');
        $id_company = session()->get('company');
        $type = 7;
        $type = auth()->user()->privileges()->wherePivot('company_id', $id_company)->wherePivot('module_id', 4)->first()->id;        
        
        return Datatables::of($coves)
            ->addColumn('check', function($cove){
                    if($cove->cove_status != '2') {
                        return '<input type="checkbox" name="chk" value="' . $cove->pk_item.'" >';
                    }
                })
            ->addColumn('tipo', function($cove){
                    if($cove->pk_tipo == '1') 
                        return 'Importación';
                    else
                        return 'Exportación';
                })
            ->addColumn('relacion', function($cove){
                    if($cove->cove_relacion == '1') 
                        return 'SI';
                    else
                        return 'NO';
                })
            ->addColumn('options', function($cove) use($type){
                    if($cove->cove_edocument != '')
                    {
                        $option = "Adendar";
                        $option_xml = '<li><a href="'.route("cove.download", $cove->pk_item).'">XML</a></li>';
                    }
                    else
                    {
                        $option = "Editar";
                        $option_xml = '';
                    }
                    if($cove->cove_status == 3 || $type == 7)
                    {
                        $option_adenda = '';
                        $option_delete = '';
                    }
                    else
                    {
                        $option_adenda = '<li><a href="'.route("cove.edit", $cove->pk_item).'">'.$option .'</a></li>';
                        $option_delete = '<li><a href="#" data-method="delete" rel="nofollow" class="delete" data-url="#" data-token="'. csrf_token() .'">Eliminar</a></li';
                    }
               
                    
                    return '<div class="dropdown">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdown-catalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones <span class="caret"></span>
                                </button>                                
                                <ul class="dropdown-menu" aria-labelledby="dropdown-catalog"> 
                                    '.$option_adenda.' 
                                    <li><a href="'.route("cove.digital", $cove->pk_item) .'">Digitalización</a></li>
                                    <li><a href="'.route("cove.show", $cove->pk_item).'" target="_blank">Visualizar</a></li>
                                    '.$option_xml.''.$option_delete.'                                          
                                </ul>
                            </div>';
                })
            ->addColumn('valid', function($cove)
            {
                if($cove->errores != '' || $cove->cove_edocument == '')
                    return '<i class="icon-cross text-color text-red"></i>';
                else
                    return '<i class="icon-checkmark text-color text-green"></i>';
            })
            ->make(true);
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
                    if($result['error'] == 0 && $cove->cove_edocument != '')
                    {
                    	$id_acuse = Cove::createAcuse($id, $seal, $company->name, $cove->pk_referencia);
                        if($id_acuse != '')
                        {
                            $file_ftp =  $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/xml/cove_'.$cove->pk_item.'.xml';
                            @rename($xml_consulta, $file_ftp);
                        }
                    }
                }
                /*else{
                    $result = 'No se creo un numero de operación';
                }*/
            }
            /*else
            {
                $result = 'No se creo xml de consulta';
            }*/
        }
        /*else
        {
            $result = 'Sellos no registrados';
        }*/
        //return response()->json(['leyenda' => $result['leyenda']]);
        return response()->json(['redirect' => '']);
        //return view('Cove.administration.result')->with(['result' => $result, 'operation' => $NoOperacion, 'id' => $id, 'acuse' => $id_acuse]);

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
        $pedimento = Pedimento::selectRaw('YEAR(ref_fechapago) as periodo')->where('pk_referencia', $cove->pk_referencia)->first();
        if(count($pedimento) > 0)
        {
            $path_ftp = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/xml/'.$pedimento->periodo.'/'.$cove->pk_referencia;
            $file = $path_ftp.'/cove_'.$cove->cove_edocument.'.xml';
        }
        else
        {
            $path_ftp = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/xml/coves';
            $file = $path_ftp.'/cove_'.$cove->cove_edocument.'.xml';
        }
        
        if(!file_exists($file)) 
        {
            $xml_cove = Cove::createXML($seal, $cove, 2, $automotriz, $path, $company->name);   
            if(!file_exists($path_ftp))     
                @mkdir($path_ftp);
            @rename($xml_cove, $file);
        }

        if(file_exists($file)) 
            return response()->download($file);

        return redirect()->back();
    }

    public function acuse($acuse)
    {
    	$id_company = session()->get('company');
    	$company = Company::find($id_company);
    	$document = Digital::find($acuse);
        $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/acuses/'.$document->pk_referencia.'/'; 
    	$file = $path.'/'.$document->imgNameFile;

    	return response()->download($file);
    }

}

