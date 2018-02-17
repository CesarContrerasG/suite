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
        $path = storage_path('modules') . '/cove/'.$company->name.'/'.$digital->pk_referencia.'/'.$digital->imgNameFile;
        $file = file_get_contents($path);

        return response($file, 200)->header('Content-Type',  'application/pdf');
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
            $noOperation = Digital::responseOperation($path, $file, $digital, $type);               
            if($noOperation != '')
            {
                $request = Digital::requestEdocument($digital, $seal, $path, $company->name);
                if(file_exists($request))
                    $result = Digital::responseEdocument($digital, $seal, $path, $request);               
            }		
        }

        return view('Cove.administration.result_digital')->with(['operacion' => $noOperation, 'result' => $result]);
     }

     public function destroy(Digital $digital)
     {
        $digital->delete();
        $path = 'framework/storage/modules/cove/ihb/'.$digital->pk_referencia.'/'.$digital->imgNameFile; 
        if(file_exists($path))
            unlink($path);
     
        return response()->json(['redirect' => '']);
     }

}