<?php 

namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Qore\Company;

class Digital extends Model{

    protected $connection = 'default';
    protected $table = 'opauimg';
    protected $guarded  =  ['iImageID'];
    protected $primaryKey='iImageID';
    public $timestamps = false;


    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function storageFile($request)
    {
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        $imgNameFile = '';        
        if ($request->hasFile('imgNameFile')) {
            $imgNameFile = $request->file('imgNameFile')->getClientOriginalName();
                        
            $request->file('imgNameFile')->storeAs($company->name.'/'.$request->pk_referencia, $imgNameFile, 'cove');
        }
        $file = storage_path().'/modules/cove/'.$company->name.'/'.$request->pk_referencia.'/'.$imgNameFile;

        //exec('convert -density 300x300 -quality 70 -compress jpeg  -resize 30%  ' .$file.' '.$file);
        return $imgNameFile;
    }

    public static function createXMLOperation($seal, $digital, $path, $company)
    {
        $mail = 'ana.sanchez@e-code.mx';
        //$email = auth()->user()->email;
        // Obtener documento
        $path_xml = $path.$company;
        if(!file_exists($path_xml))
            mkdir($path_xml, 0755);

        $file = storage_path('modules/cove/'.$company.'/'.$digital->pk_referencia).'/'.$digital->imgNameFile;
        $file = file_get_contents($file);
		$file_base64 = base64_encode($file);
        $name_file = basename($digital->imgNameFile, ".pdf");
		$cadena = "|" . $seal->sello_rfc . "|".$mail."|".$digital->imgtipodoc."|".$name_file."|";
        if (!empty($digital->imgRfc))
		    $cadena = $cadena . $digital->imgRfc."|";
		$hashdoc = sha1($file);
		$cadena = $cadena . $hashdoc ."|";
		openssl_sign($cadena, $crypttext, $seal->sello_key64, OPENSSL_ALGO_SHA256);       
		$firma_consulta = base64_encode($crypttext);		
        $leer_xml = simplexml_load_file($path."digitalizacion.xml"); 
        $new_file = $path_xml.'/request_operation_'.$digital->iImageID.'.xml';
        $ns = Digital::namespaces($leer_xml);
        Cove::tokenSecurity($leer_xml, $ns, $seal);
        foreach ($leer_xml->xpath('//'. $ns['prefix_dig'] . 'registroDigitalizarDocumentoServiceRequest') as $request)
        {        
            $request->children($ns['dig'])->correoElectronico = $mail;
            $document = $request->children($ns['dig'])->documento;
            $document->children($ns['dig'])->idTipoDocumento = $digital->imgtipodoc;
            $document->children($ns['dig'])->nombreDocumento = $name_file;
            $document->children($ns['dig'])->rfcConsulta = $digital->imgRfc;
            $document->children($ns['dig'])->archivo = $file_base64;
            $firma = $request->children($ns['dig'])->peticionBase->children($ns['res'])->firmaElectronica;
            $firma->children($ns['res'])->certificado = $seal->sello_cer64;
            $firma->children($ns['res'])->cadenaOriginal = $cadena;
            $firma->children($ns['res'])->firma = $firma_consulta;
        }
        $leer_xml->saveXML($new_file);
        
		$digital->imgCadenaOriginal = $cadena;
		$digital->imgSello = $firma_consulta;
        $digital->errores = '';
		$digital->save();

        return $new_file;
    }

    public static function responseOperation($path, $request, $digital, $type)
    {
        $acuse = $path.'/acuse_edocument_' . $digital->iImageID . '.xml';
        $noOperacion = $digital->imgNumeroOperacion;
        $envio_xml = "curl -o " . $acuse . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla/DigitalizarDocumentoService" . '"' . " -d @" . $request . " https://www.ventanillaunica.gob.mx/ventanilla/DigitalizarDocumentoService";
		if(is_null($noOperacion) || (!is_null($noOperacion) && $type == 0) || ($type == 1 && $digital->errores != ''))
            exec($envio_xml);

        if (file_exists($acuse))
		{
            $file_content = file_get_contents($acuse,NULL, NULL, 225) or die("No se pudo abrir el archivo");
            $posOp = strpos($file_content,'<ns2:numeroOperacion>') + 21;
            $posFin = strpos($file_content,'</ns2:numeroOperacion>') - $posOp;
            $noOperacion = substr($file_content,$posOp,$posFin);
            if(strlen($noOperacion) < 15)
            {
                $digital->imgNumeroOperacion = $noOperacion;
                $digital->save();

                return $noOperacion;
            }
		}
        return false;
    }

    public static function requestEdocument($digital, $seal, $path, $company)
    {
        $cadena_consulta = "|". $seal->sello_rfc . "|" . $digital->imgNumeroOperacion . "|";
		openssl_sign($cadena_consulta, $crypttext, $seal->sello_key64, OPENSSL_ALGO_SHA256);	
		$firma_consulta = base64_encode($crypttext);	
        $xmlconsulta = $path . 'consulta.xml';	
		$new_xml = $path . $company.'/request_' . $digital->iImageID. '.xml';
        $leer_xml = simplexml_load_file($path."consulta.xml"); 
        $ns = Digital::namespaces($leer_xml);
        Cove::tokenSecurity($leer_xml, $ns, $seal);
        foreach ($leer_xml->xpath('//'. $ns['prefix_dig'] . 'consultaDigitalizarDocumentoServiceRequest') as $request)
        {
            $request->children($ns['dig'])->numeroOperacion = $digital->imgNumeroOperacion;
            $data = $request->children($ns['dig'])->peticionBase->children($ns['res'])->firmaElectronica;
            $data->children($ns['res'])->certificado =  $seal->sello_cer64;
            $data->children($ns['res'])->cadenaOriginal = $cadena_consulta;
            $data->children($ns['res'])->firma = $firma_consulta;
        }
        $leer_xml->saveXML($new_xml);

        return $new_xml;
    }

    public static function responseEdocument($digital, $seal, $path, $request)
    {
        $respuesta_consulta = $path. "/response_edocument_" . $digital->iImageID . '.xml';	
		$envio_consulta = "curl -o " . $respuesta_consulta . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla/DigitalizarDocumentoService" . '"' . " -d @" . $request . " https://www.ventanillaunica.gob.mx/ventanilla/DigitalizarDocumentoService";
		exec($envio_consulta);	
        $eDocument = '';
        $leyenda = '';
        $error = 'true';
        if(file_exists($respuesta_consulta))
		{			
            $doc_xml = file_get_contents($respuesta_consulta);
            dd($doc_xml);
            preg_match("/<ns2:respuestaBase><tieneError>(.*?)<\/tieneError><\/ns2:respuestaBase>/", $doc_xml , $_error); 
            $error = $_error[1];
            if($error == 0)
            {
                preg_match("/<ns2:numeroDeTramite>(.*?)<\/ns2:numeroDeTramite>/", $doc_xml , $_tramite); 
                preg_match("/<ns2:eDocument>(.*?)<\/ns2:eDocument>/", $doc_xml , $_edocument); 
                preg_match("/<ns2:cadenaOriginal>(.*?)<\/ns2:cadenaOriginal>/", $doc_xml , $_cadena); 
                $tramite = $_tramite[1];
                $eDocument = $_edocument[1];
                $cadena = $_cadena[1];
                $leyenda = 'Tiene 90 días a partir de esta fecha para utilizar su documento digitalizado, si en ese tiempo no lo utiliza, será dado de baja del sistema.';
                $errores = '';

            }
            else
            {
                preg_match("/<ns2:respuestaBase><error><mensaje>(.*?)<\/mensaje><\/error><\/ns2:respuestaBase>/", $doc_xml , $_mensaje);
                $leyenda = $_mensaje;
                $tramite = '';
                $cadena = '';
                $errores = $leyenda;
            }
        }

		$digital->imgEdocument = $eDocument;
		$digital->imgFechaEdoc = date("Y-m-d"); 
		$digital->imgNumeroTramite = $tramite; 
		$digital->imgCadenaTramite = $cadena;
        $digital->errores = $errores;
		$digital->save();
        $acuse = Digital::createAcuse($digital->iImageID, $seal);


        return ['leyenda' => $leyenda, 'edocument' => $eDocument, 'error' => $error, 'acuse' => $acuse];
		
    }

    public static function namespaces($xml)
    {
        $namespaces = $xml->getDocNamespaces();  
        if (!empty($namespaces)) 
        {
            $ns = $xml->getNamespaces(true);
            $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');  
            $xml->registerXPathNamespace('dig', 'http://www.ventanillaunica.gob.mx/aga/digitalizar/ws/oxml/DigitalizarDocumento');  
            $xml->registerXPathNamespace('res', 'http://www.ventanillaunica.gob.mx/common/ws/oxml/respuesta');  
            $wsseprefix = 'wsse:';
            $digprefix = 'dig:';
            $resprefix = 'res:';
            $wsse = $ns['wsse'];
            $dig = $ns['dig'];
            $res = $ns['res'];
        } else {
            $wsseprefix = '';
            $digprefix = '';
            $resprefix = '';
            $wsse = ''; 
            $dig = '';
            $res = '';
        }

        $data = [
            'prefix_wsse' => $wsseprefix,
            'prefix_dig' => $digprefix,
            'prefix_res' => $resprefix,
            'wsse'        => $wsse,
            'dig'        => $dig,
            'res'        => $res
        ];

        return $data;
    }

     public static function createAcuse($id, $seal)
    {
        $acuse = '';
        $digital = Digital::find($id);
        $id_company = session()->get('company');
        $company = Company::find($id_company);
        $path = storage_path().'/modules/cove/'.$company->name.'/'.$digital->pk_referencia.'/';  
        $name_file =  'Acuse_'.$digital->imgNameFile;

        $data = [
            'pk_referencia' => $digital->pk_referencia,
            'cove_factura' => $digital->cove_factura,
            'imgNameFile' => $name_file,
            'strImageName' => 'Acuse  --> '.$digital->imgEdocument,
            'imgtipodoc' => '000'
        ];
        if(!is_null($data))
            $acuse = Digital::insertGetId($data);       
        
        \PDF::loadView('Cove.administration.template_acuse_ED', compact('company','digital'))->save($path.$name_file);

        return $acuse;
    }
    
    

}