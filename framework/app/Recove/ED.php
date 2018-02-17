<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\Qore\Document;
use App\Qore\Company;
use App\Recove\AgentED;

class ED extends Model{
    protected $connection = 'default';
    protected $table = 'opauimg';
    protected $guarded = ['iImageID'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
    }

    public function getRouteKeyName()
    {
        return 'iImageID';
    }

    public static function generarXML($path, $seals, $edocument)
    {

        
		$xml = simplexml_load_file($path."edocument.xml");		
        $xml->registerXPathNamespace('tem', 'http://tempuri.org/');
        $namespaces = $xml->getNamespaces(true);
        foreach ($xml->xpath('//soapenv:Header') as $token)
        {
            $token->children($namespaces['tem'])->UserName = $seals->sello_rfc;
            $token->children($namespaces['tem'])->Password = $seals->sello_wsp;
        }
		foreach ($xml->xpath('//tem:DocumentoIn') as $ed)
	    { 
	        $ed->children($namespaces['tem'])->Edocument = $edocument;
	        if(!file_exists($path.'edocument_'.$edocument.'.xml'))
	        	$xml->saveXML($path.'edocument_'.$edocument.'.xml');
	    }
	    

	    return 'edocument_'.$edocument.'.xml';
    }

    public static function leerXML($respuesta_consulta, $edocument, $empresa, $referen,$periodo)
	{
		$result = 0;
		$file = '';
		$error = '';
		$name_file = explode('_', $empresa->db);
		$path_ftp = '/home/secenet/public_html/clientes/ftp/'.$name_file[1].'/pdf/'.$periodo.'/'.$referen.'/'; 
		echo $path_ftp;
		if(!file_exists($path_ftp))
			@mkdir($path_ftp);
		if (file_exists($respuesta_consulta))
		{		
			$doc_xml = @simplexml_load_file($respuesta_consulta);			
			foreach ($doc_xml->xpath('//s:Body') as $respuesta)
			{
				$error = $respuesta->DocumentoOut->Errores;
	
				if($error == 'OK')
				{				
					$cadena = $respuesta->DocumentoOut->CadenaOriginal;
					$sello = $respuesta->DocumentoOut->SelloDigital;
					$archivo = $respuesta->DocumentoOut->File;
					$string = explode('|', $cadena);	
					if(isset($string[4]))
						$file = $string[4];
					else
						$file = $edocument.'.pdf';

					$clave = $respuesta->DocumentoOut->TipoDocumento;
					$docum = Document::where('doc_clave', $clave)->first();
					if(is_null($docum))
						$name_docum = 'No existe documento';
					else
						$name_docum = $docum->doc_nombre;
					if(isset($string[5]))
						$rfccon = $string[5];
					else
						$rfccon = '';

					if($cadena == '')
						$cadena = '|'.$empresa->rfc.'|'.$clave.'|'.$file.'|';
				
					$data = [
				        'pk_referencia' => $referen,
						'imgNameFile' => $file,
						'strImageName' => $name_docum,
						'imgtipodoc' => $clave,
						'imgRfc' => $rfccon,
						'imgEdocument' => $edocument,
						'imgFechaEdoc'  => null,
						'imgCadenaOriginal' => $cadena,
						'imgSello' => $sello
				    ];

					if(!is_null($data))
						ED::insert($data);
					if($archivo!=''){
						$binary = base64_decode($archivo);
						file_put_contents($path_ftp.$file, $binary);	
						$result = 1;			
					}						
				}
				else
				{
					if($respuesta->DocumentoOut->TieneError == true)
						$result = 2;
				}
			}			
		}
		
	
		return ['status' => $result, 'file' => $file,'error' => $error];
	}
	public static function crearAcuse($eDocument,$referen, $periodo,$empresa)
    {
        $path_ftp = '/home/secenet/public_html/clientes/ftp/'.$empresa.'/'.'pdf/'.$periodo.'/'.$referen.'/'; 
        
        $data = [
            'pk_referencia' => $referen,
            'imgNameFile' => $referen.'_Acuse_'.$eDocument.'.pdf',
            'strImageName' => 'Acuse->'.$eDocument,
            'imgtipodoc' => '000'
        ];

        if(!is_null($data))
			ED::insert($data);
  
   		$patente = explode('-',$referen); 
        $document = ED::where('imgEdocument',$eDocument)->first(); 		
  		

  		if($document->imgRfc != '')
        	$data_firma = AgentED::select('age_razon as name','age_rfc as rfc')->where('pk_age',$patente[1])->first();
        else
        	$data_firma = Company::select('business_name as name','rfc')->where('name',$empresa)->first();
		
		if(!file_exists($path_ftp))
        	mkdir($path_ftp,0777, true);

        $pdf = \PDF::loadView('Recove.template_acuse_ED', compact('document','data_firma'))->save($path_ftp.$referen.'_Acuse_'.$eDocument.'.pdf');
        $file_acuse = $path_ftp.$referen.'_Acuse_'.$eDocument.'.pdf';

        return $file_acuse;
    }
}