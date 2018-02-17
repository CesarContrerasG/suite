<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\DigitalRequest;
use App\Cove\Digital;
use App\Cove\Cove;
use App\Qore\Document;
use App\Cove\Seal;
use App\Qore\Company;
use App\Recove\Pedimento;


class DigitalController extends Controller
{

    public function show(Cove $cove, DigitalRequest $request)
    {
        $referencia = $cove->pk_referencia;
        $digital = Digital::where('pk_referencia', $referencia)->get();
        
        return view('Cove.administration.digital')->with(['cove' => $referencia, 'digital' => $digital]);   
    }

    public function store(DigitalRequest $request)
    {
        $document = Document::where('doc_clave', $request->imgtipodoc)->first();
        $digital = new Digital;
        $digital->pk_referencia = $request->pk_referencia;
        $digital->imgtipodoc = $request->imgtipodoc;
        $digital->strImageName = $document->doc_nombre;
        $digital->cove_factura = $request->pk_referencia;
        $digital->imgRfc = $request->imgRfc;
        $imgNameFile = Digital::storageFile($request);  
        $digital->imgNameFile = $imgNameFile;
        $digital->save();    
        
        return redirect()->back();
    }

    public function view(Digital $digital)
    {
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        $pedimento = Pedimento::selectRaw('YEAR(ref_fechapago) as periodo')->where('pk_referencia', $digital->pk_referencia)->first();
        if(count($pedimento) == 0)
            if($digital->imgtipodoc == '000')
                $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/acuses/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
            else
                $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/ED/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
        else
            $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/'.$pedimento->periodo.'/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
        
        if(file_exists($path))
        {
            $file = file_get_contents($path);
            return response($file, 200)->header('Content-Type',  'application/pdf');
        }

        return redirect()->back();
    }

    public function sign($id, $type)
    {
        $digital = Digital::find($id);
        $seal = Seal::first();
        $path = storage_path('xml') . '/edocument/'; 
        $result = '';
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        if(!is_null($seal))
        {
            $file = Digital::createXMLOperation($seal, $digital, $path, $company->name); 
            $noOperation = Digital::responseOperation($path.$company->name, $file, $digital, $type);
            if($noOperation != 0)
            {
                $request = Digital::requestEdocument($digital, $seal, $path, $company->name);
                if(file_exists($request))
                {
                    $result = Digital::responseEdocument($digital, $seal, $path.$company->name, $request);
                }
            }		
        }
        return view('Cove.administration.result_digital')->with(['operacion' => $noOperation, 'result' => $result, 'id' => $digital->iImageID]);
    }

    public function destroy(Digital $digital)
    {
        $id_company = session()->get('company');
        $company = Company::find($id_company);        
        $pedimento = Pedimento::selectRaw('YEAR(ref_fechapago) as periodo')->where('pk_referencia', $digital->pk_referencia)->first();
        if(count($pedimento) == 0)
            if($digital->imgtipodoc == '000')
                $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/acuses/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
            else
                $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/ED/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
        else
            $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/'.$pedimento->periodo.'/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
        if(file_exists($path))
            unlink($path);
        $digital->delete();
     
        return response()->json(['redirect' => '']);
    }

    public function acuse($acuse)
    {
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        $document = Digital::find($acuse);
        $file = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/pdf/acuses/'.$document->pk_referencia.'/'.$document->imgNameFile;

        return response()->download($file);
    }

}