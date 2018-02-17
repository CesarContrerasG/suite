<?php 
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Qore\Company;
use App\Cove\Patent;
use App\Cove\Digital;
use App\Recove\PedimentoPrueba;
use App\User;

class CovePrueba extends Model{

    protected $connection = 'default';
    protected $table = 'cove_encabezado';
    protected $guarded  =  ['pk_item'];
    protected $primaryKey = 'pk_item';
    public $timestamps = false;
    
    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function getRouteKeyName()
    {
        return 'pk_item';
    }

    /*============================================================================================
                                        RELACIONES CON COVE     
    =============================================================================================*/
    public function invoices()
    {
        return $this->hasMany('App\Cove\Invoice', 'pk_item', 'pk_item');
    }
    public function inventory()
    {
        return $this->hasMany('App\Cove\Inventory', 'inv_item', 'pk_item');
    }
    public function consultations()
    {
        return $this->hasMany('App\Cove\RFCConsult', 'cove_factura','cove_factura');
    }
    //============================================================================================
    public static function insertOrUpdate($cove, $request)
    {
        $relacion = 0;
        if($request->cove_relacion == 'on')
            $relacion = 1;
        $cove->pk_tipo = $request->pk_tipo;
        $cove->cove_patente = $request->cove_patente;
        $cove->pk_referencia = $request->pk_referencia;
        $cove->cove_factura = $request->cove_factura;
        $cove->cove_fecha = $request->cove_fecha;            
        $cove->cove_relacion = $relacion;
        $cove->cove_noexpconfiable = $request->cove_noexpconfiable;
        $cove->cove_rfcconsulta = $request->cove_rfcconsulta;
        $cove->cove_observa = $request->cove_observa;
        $cove->save();
    }
    
    public static function createXML($seal, $cove, $type, $automotriz, $path, $id_company)
    {         
        $company = Company::find($id_company)->name;
        //========================= XML para Cadena Original===================================
        if($type == 1)
        {   
            $new_file = $path.$company.'/cadena_'.$cove->pk_item.'.xml';
            if($cove->cove_relacion == 0)
                $file = "cadena.xml";
            elseif($automotriz == 1)
                    $file = "cadena_ia.xml";
                else
                    $file = "cadena_nia.xml";
            
        }
        //============================== XML Para Consulta  ===================================
        else
        {
            $new_file = $path.$company.'/cove_'.$cove->pk_item.'.xml';
            if($cove->cove_relacion == 0)
                $file = "cove.xml";
            elseif($automotriz == 1)
                    $file = "cove_ia.xml";
                else
                    $file = "cove_nia.xml";
        }
        
        $leer_xml = simplexml_load_file($path.$file);
 
        $ns = CovePrueba::namespaces($leer_xml);        
        CovePrueba::tokenSecurity($leer_xml, $ns, $seal);
        // Comprobante
        foreach ($leer_xml->xpath('//'. $ns['prefix_oxml'] . 'comprobantes') as $comprobante)
        {            
            $tag_encabezado = $comprobante->children($ns['oxml']);
            // Encabezado 
            CovePrueba::encabezado($cove, $seal, $tag_encabezado, $ns['oxml'],  $ns['prefix_oxml'], $id_company);
            // Factura     
            if($cove->cove_relacion == 1)
                $comprobante->addChild($ns['prefix_oxml'] . 'numeroRelacionFacturas', $cove->cove_factura);           
            else
                $comprobante->addChild($ns['prefix_oxml'] . 'numeroFacturaOriginal', $cove->cove_factura);           
            
            foreach($cove->invoices()->get() as $id => $invoice )
            {
                if($automotriz != 0)
                   CovePrueba::emisorAndDestinatario($comprobante, $invoice, $ns['oxml'], $ns['prefix_oxml']);
                
                CovePrueba::factura($cove, $invoice, $id, $cove->cove_relacion, $comprobante, $ns['prefix_oxml'], $ns['oxml'], $automotriz);  
                if($cove->cove_relacion == 0)
                {
                    if($automotriz == 0)
                        CovePrueba::emisorAndDestinatario($comprobante, $invoice, $ns['oxml'], $ns['prefix_oxml']);
                    foreach($cove->inventory()->get() as $idinv => $inventory )
                        CovePrueba::mercancias($comprobante, $inventory, $ns['oxml'], $ns['prefix_oxml'], $idinv);
                }
            }
        }
        $leer_xml->saveXML($new_file);
        $content =  file_get_contents($new_file);
        $content = str_replace("&amp;", "&", $content);
        file_put_contents($new_file, $content) or die('file not found'); 
        

        return $new_file;
        
    }
    public static function tokenSecurity($xml, $ns, $seal)
    {
        foreach ($xml->xpath('//'. $ns['prefix_wsse'] . 'UsernameToken') as $token)
        {
            $token->children($ns['wsse'])->Username = $seal->sello_rfc;
            $token->children($ns['wsse'])->Password = $seal->sello_wsp;
        }
    }

    public static function namespaces($xml)
    {
        $namespaces = $xml->getDocNamespaces();  
        $oxml = '';
        $ns2 = '';
        $wsseprefix = '';
        $oxmlprefix = '';
        $wsse = ''; 

        if (!empty($namespaces)) 
        {
            $ns = $xml->getNamespaces(true);
            $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');  
            $xml->registerXPathNamespace('oxml', 'http://www.ventanillaunica.gob.mx/cove/ws/oxml/');  
            $xml->registerXPathNamespace('ns2', 'http://www.ventanillaunica.gob.mx/ConsultarEdocument/');
            $wsseprefix = 'wsse:';
            $oxmlprefix = 'oxml:';
            $wsse = $ns['wsse'];
            if(isset($ns['oxml']))
                $oxml = $ns['oxml'];
            if(isset($ns['ns2']))
                $ns2 = $ns['ns2'];
        } 
        $data = [
            'prefix_wsse' => $wsseprefix,
            'prefix_oxml' => $oxmlprefix,
            'wsse'        => $wsse,
            'oxml'        => $oxml,
            'ns2'         => $ns2
        ];
        return $data;
    }

    public static function createString($xml_cadena, $cove, $seal, $path)
    {
        // Cargar XML con informacion del COVE
        $content =  file_get_contents($xml_cadena);
        $content = str_replace("&ntilde;", "ñ", $content);
        file_put_contents($xml_cadena, $content) or die('file not found'); 
   
        $dom= new \DOMDocument('1.0', 'UTF-8');
        $dom->load($xml_cadena);
        $xsl = new \DOMDocument();
        $xsl->load($path.'/Cove02.xsl');        
        // Crear el procesador XSLT que nos generará la cadena original con las reglas de transformación
        $proc = new \XSLTProcessor;
        $proc->importStyleSheet($xsl);
        // Generar la cadena original y asignarla a una variable
        $cadena = $proc->transformToDoc($dom)->saveXML();
        $cadena = substr($cadena, strpos($cadena,'|'));
        $cadena = substr($cadena, 0, strrpos($cadena,'|')+1);
        $cadena = substr($cadena, strpos($cadena,'|'));
        $cadena = html_entity_decode($cadena);
        // Generar sello de la cadena original
        $signature = Seal::encrypt($cadena, $seal);
        $sello = base64_encode($signature);
        //openssl_free_key($pkeyid);
        
        $cove->cove_cadenaoriginal = $cadena;
        $cove->cove_sellosolicita = $sello;
        $cove->save();
        //unlink($xml_cadena);
    }

    public static function encabezado($cove, $seal, $tag_encabezado, $oxml, $prefix, $company)
    {
        //$email = auth()->user()->email;
        $user = User::where('company_id', $company)->first();
        $email = $user->email;
        if($cove->pk_tipo == 1)
            $operacion = 'TOCE.IMP';
        else
            $operacion = 'TOCE.EXP';
        if($cove->cove_observa != '')
        {
            $tag_encabezado->addChild($prefix . 'observaciones'); 
			$observaciones = htmlentities($cove->cove_observa);
            $tag_encabezado->observaciones =  "$observaciones";
        }
        if($cove->cove_edocument != '')
        {
            $tag_encabezado->addChild($prefix . 'e-document'); 
            $tag_encabezado->{'e-document'} = $cove->cove_edocument;
        }
        $tag_encabezado->tipoOperacion = $operacion;
        $tag_encabezado->patenteAduanal = $cove->cove_patente;
        $tag_encabezado->fechaExpedicion = $cove->cove_fecha;
        $tag_encabezado->tipoFigura = $seal->sello_tipofigura;
        $tag_encabezado->correoElectronico = $email;
        $tag_firma = $tag_encabezado->firmaElectronica->children($oxml);
        $tag_firma->certificado = $seal->sello_cer64;
        $tag_firma->cadenaOriginal = htmlentities($cove->cove_cadenaoriginal); 
        $tag_firma->firma = $cove->cove_sellosolicita;
        $tag_encabezado->rfcConsulta = $cove->cove_rfcconsulta;
        foreach($cove->consultations()->get() as $rfc)
            $tag_encabezado->rfcConsulta = $rfc->cove_rfcconsulta;
        
    }

    public static function factura($cove, $invoice, $id, $relacion, $comprobante, $prefix, $oxml, $automotriz)
    {
        if($relacion == 1)
        {             
            $comprobante->addChild($prefix . 'facturas');   
            $tag_facturas = $comprobante->children($oxml)->facturas[$id];
        }
        else
        {
            $comprobante->addChild($prefix . 'factura');   
            $tag_facturas = $comprobante->children($oxml)->factura;
        }
       
        $tag_facturas->addChild($prefix . 'certificadoOrigen',$invoice->inv_certorigen);
        if($invoice->inv_noexpconfiable != '')
         $tag_facturas->addChild($prefix . 'numeroExportadorAutorizado', $invoice->inv_noexpconfiable);   
        $tag_facturas->addChild($prefix . 'subdivision', $invoice->inv_subdivision);   
        if($relacion == 1)
        {
            $tag_facturas->addChild($prefix . 'numeroFactura', $invoice->inv_factura);   
            if($automotriz == 0)
                CovePrueba::emisorAndDestinatario($tag_facturas, $invoice, $oxml, $prefix);                
                       
            foreach($cove->inventory()->where('inv_factura', $invoice->inv_factura)->get() as $idinv => $inventory)
            {
                CovePrueba::mercancias($tag_facturas, $inventory, $oxml, $prefix, $idinv);
            } 
        }       
    }

    public static function emisorAndDestinatario($tag, $invoice, $oxml, $prefix)
    {
        $tag->addChild($prefix . 'emisor');        
        $emisor =  $tag->children($oxml)->emisor;
        $tag->addChild($prefix . 'destinatario');
        $destinatario =  $tag->children($oxml)->destinatario;
        $emisor->addChild($prefix. 'tipoIdentificador', $invoice->emisor_tipoid);
        $emisor->addChild($prefix. 'identificacion', $invoice->emisor_identificador);
        if($invoice->emisor_paterno != '')
         $emisor->addChild($prefix. 'apellidoPaterno', $invoice->emisor_paterno);
        if($invoice->emisor_materno != '')
         $emisor->addChild($prefix. 'apellidoMaterno', $invoice->emisor_materno);
        $emisor->addChild($prefix. 'nombre');
        //dd($invoice->emisor_nombre);
        $emisor->children($oxml)->nombre = htmlentities($invoice->emisor_nombre);
        //htmlspecialchars(strip_tags($invoice->emisor_nombre));
        $emisor->addChild($prefix . 'domicilio');
        $domicilio_emi = $emisor->domicilio;
        $domicilio_emi->addChild($prefix. 'calle', $invoice->emisor_calle);
        if($invoice->emisor_noext != '')
         $domicilio_emi->addChild($prefix. 'numeroExterior', $invoice->emisor_noext);
        if($invoice->emisor_noint != '')
         $domicilio_emi->addChild($prefix. 'numeroInterior', $invoice->emisor_noint);
        if($invoice->emisor_col != '')
         $domicilio_emi->addChild($prefix. 'colonia', $invoice->emisor_col);
        if($invoice->emisor_localidad != '')
         $domicilio_emi->addChild($prefix. 'localidad', $invoice->emisor_localidad);
        if($invoice->emisor_mpo != '')
         $domicilio_emi->addChild($prefix. 'municipio', $invoice->emisor_mpo);
        if($invoice->emisor_edo != '')
         $domicilio_emi->addChild($prefix. 'entidadFederativa', $invoice->emisor_edo);
        $domicilio_emi->addChild($prefix. 'pais', $invoice->emisor_pais);
        if($invoice->emisor_cp != '')
         $domicilio_emi->addChild($prefix. 'codigoPostal', $invoice->emisor_cp);
       
        $destinatario->addChild($prefix. 'tipoIdentificador', $invoice->dest_tipoid);
        $destinatario->addChild($prefix. 'identificacion', $invoice->dest_identificador);
        if($invoice->dest_paterno != '')
         $destinatario->addChild($prefix. 'apellidoPaterno', $invoice->dest_paterno);
        if($invoice->dest_materno != '')
         $destinatario->addChild($prefix. 'apellidoMaterno', $invoice->dest_materno);
        $destinatario->addChild($prefix. 'nombre', $invoice->dest_nombre);
        $destinatario->addChild($prefix . 'domicilio');
        $domicilio_dest = $destinatario->domicilio;
        $domicilio_dest->addChild($prefix. 'calle', $invoice->dest_calle);
        if($invoice->dest_noext != '')
         $domicilio_dest->addChild($prefix. 'numeroExterior', $invoice->dest_noext);
        if($invoice->dest_noint != '')
         $domicilio_dest->addChild($prefix. 'numeroInterior', $invoice->dest_noint);
        if($invoice->emisor_col != '')
         $domicilio_dest->addChild($prefix. 'colonia', $invoice->dest_col);
        if($invoice->dest_localidad != '')
         $domicilio_dest->addChild($prefix. 'localidad', $invoice->dest_localidad);
        if($invoice->dest_mpo != '')
         $domicilio_dest->addChild($prefix. 'municipio', $invoice->dest_mpo);
        if($invoice->dest_edo != '')
         $domicilio_dest->addChild($prefix. 'entidadFederativa', $invoice->dest_edo);
        $domicilio_dest->addChild($prefix. 'pais', $invoice->dest_pais);
        if($invoice->dest_cp != '')
         $domicilio_dest->addChild($prefix. 'codigoPostal', $invoice->dest_cp);
    }
    
    public static function mercancias($tag, $inventory, $oxml, $prefix, $id)
    {
        $tag->addChild($prefix . 'mercancias');  
        $mercancias =  $tag->children($oxml)->mercancias[$id]; 
        $mercancias->addChild($prefix. 'descripcionGenerica', $inventory->inv_descove);  
        $mercancias->addChild($prefix. 'claveUnidadMedida', $inventory->inv_oma);  
        $mercancias->addChild($prefix. 'tipoMoneda', $inventory->inv_moneda);  
        $mercancias->addChild($prefix. 'cantidad', $inventory->inv_cantidad);  
        $mercancias->addChild($prefix. 'valorUnitario', $inventory->inv_valorunitario);  
        $mercancias->addChild($prefix. 'valorTotal', $inventory->inv_valortotal);  
        $mercancias->addChild($prefix. 'valorDolares', $inventory->inv_valorusd);  
        if($inventory->details()->count() > 0)
        {
            $mercancias->addChild($prefix . 'descripcionEspecificas');  
            foreach($inventory->details()->get() as $detail)
            {
                $especificas =  $mercancias->children($oxml)->descripcionEspecificas;         
                if($detail->inv_marca != '')
                 $especificas->addChild($prefix . 'marca', $detail->inv_marca);  
                if($detail->inv_modelo != '')
                 $especificas->addChild($prefix . 'modelo', $detail->inv_modelo);  
                if($detail->inv_submodelo != '')
                 $especificas->addChild($prefix . 'subModelo', $detail->inv_submodelo);  
                if($detail->inv_noserie != '')
                 $especificas->addChild($prefix . 'numeroSerie', $detail->inv_noserie);  
            }
        }
    }

    public static function responseOperation($cove, $xml_consulta, $type, $automotriz, $path, $company)
    {
        $NoOperacion = $cove->cove_operacion;
        $acuse = $path . $company.'/acuse_cove_'.$cove->pk_item.'.xml';
        
        $envio_xml = "curl -o " . $acuse . " -k -H " . '"' ."Content-Type: text/xml; encoding=utf-8" . '"' . " -H " . '"' ."SOAPAction:http://www.ventanillaunica.gob.mx/RecibirCove" . '"' . " -d @" . $xml_consulta . " https://www.ventanillaunica.gob.mx/ventanilla/RecibirCoveService";
        if(is_null($NoOperacion) || ($cove->cove_edocument != ''  && $type == 0) || ($NoOperacion != '' && $cove->errores != '')) 
            exec($envio_xml);   
                
        if (file_exists($acuse))
		{			
		    $acuse_xml = simplexml_load_file($acuse);
			try
			{
			    foreach ($acuse_xml->xpath('//S:Body') as $respuesta)				
				{
				    if($cove->cove_relacion == 1)
					{
					    if($automotriz == 1)
						    $NoOperacion = $respuesta->solicitarRecibirRelacionFacturasIAServicioResponse->numeroDeOperacion;
						else
						    $NoOperacion = $respuesta->solicitarRecibirRelacionFacturasNoIAServicioResponse->numeroDeOperacion;										
                    }
                    else
					{
                        $NoOperacion = $respuesta->solicitarRecibirCoveServicioResponse->numeroDeOperacion;															
					}
                }
			}catch (Exception $e) {
			    $NoOperacion = '';						
			}        
        }
        $cove->errores = '';
        $cove->cove_operacion = $NoOperacion;
        $cove->save();
        return $NoOperacion;
    }

    public static function response($NoOperacion, $seal, $cove, $path, $company)
    {
        $edocument ='';
        $adenda = '';
        $tieneError = 'true';
        $leyenda = 'Error al recibir respuesta de VUCEM';
        $cadena_consulta = "|". $NoOperacion . "|" . $seal->sello_rfc. "|";
        $crypttext = Seal::encrypt($cadena_consulta, $seal);
		$firma_consulta = base64_encode($crypttext);		
        $leer_xml = simplexml_load_file($path.'request_cove.xml'); 
        $ns = CovePrueba::namespaces($leer_xml); 
        CovePrueba::tokenSecurity($leer_xml, $ns, $seal);
        foreach ($leer_xml->xpath('//'.$ns['prefix_oxml'] . 'solicitarConsultarRespuestaCoveServicio') as $operacion)
        {
            $operacion->children($ns['oxml'])->numeroOperacion = $NoOperacion;
            $firma = $operacion->children($ns['oxml'])->firmaElectronica;
            $firma->certificado = $seal->sello_cer64;
            $firma->cadenaOriginal = $cadena_consulta;
            $firma->firma = $firma_consulta;
        }
		$xmlconsulta = $path . $company."/request_cove_" . $cove->pk_item .".xml";
		$leer_xml->saveXML($xmlconsulta);  	
        if(file_exists($xmlconsulta))
        {
            $respuesta_consulta = $path . $company."/response_cove_" . $cove->pk_item .".xml";
			$envio_consulta = "curl -o " . $respuesta_consulta . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:http://www.ventanillaunica.gob.mx/ConsultarRespuestaCove" . '"' . " -d @" . $xmlconsulta . " https://www.ventanillaunica.gob.mx/ventanilla/ConsultarRespuestaCoveService";
			exec($envio_consulta);
			if (file_exists($respuesta_consulta))
            {			
                $doc_xml = simplexml_load_file($respuesta_consulta);
                foreach ($doc_xml->xpath('//S:Body') as $respuesta)
                {
                    $edocument = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->respuestasOperaciones->eDocument;
                    $fechaedo = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->horaRecepcion;
                    $tieneError = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->respuestasOperaciones->contieneError;
                    $leyenda = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->leyenda;
                    $adenda = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->respuestasOperaciones->numeroAdenda;
                    
                    if($edocument != '')
                    {
                        $cove->cove_edocument = $edocument;							
                        $cove->cove_fecha_edocument = date("Y-m-d",strtotime($fechaedo));
                        $cove->cove_status = 3;
                    }	
                    if($adenda!='')
                    {
                        $cove->cove_adenda = $cove->cove_adenda + 1;
                        $cove->cove_numadenda = $adenda;
                    }
                    $cove->save();
                    $errores_txt = '';
                    if(isset($tieneError))
                    {
                        if($tieneError == 'true')
                        {
                            
                            $errores = $respuesta->solicitarConsultarRespuestaCoveServicioResponse->respuestasOperaciones->errores;
                            foreach ($errores->mensaje as $error) 
                            {
                                $errores_txt .= $error."\n";
                                
                            }                            
                            $leyenda = $errores_txt;
                        }
                    }
                    else
                    {
                        $errores_txt = $leyenda;
                    }

                    $cove->errores = $errores_txt;
                    $cove->save();
                }
            }
            
        }
        
       return ['edocument' => $edocument, 'adenda' => $adenda, 'error' => $tieneError, 'leyenda' => $leyenda ];
    }

    public static function createAcuse($id, $seal, $company, $referen)
    {
        $data_cove = CovePrueba::find($id);
        $acuse = '';
        if($seal->sello_tipofigura != 1)
        {
            $data_firma = Company::select('business_name as name','rfc')->where('rfc',$seal->sello_rfc)->first();
        }
        else
        {
            $data_firma = Patent::select('age_razon as name','age_rfc as rfc')->where('pk_age',$data_cove->patente)->first();
            if(is_null($data_firma))
                $data_firma = Company::select('business_name as name','rfc')->where('username', $seal->sello_rfc)->first();
        }
        $pedimento = PedimentoPrueba::selectRaw('YEAR(ref_fechapago) as periodo')->where('pk_referencia', $data_cove->pk_referencia)->first();
        if(count($pedimento) == 0)
           $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company.'/pdf/acuses/'.$referen; 
        else
            $path = $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company.'/pdf/'.$pedimento->periodo.'/'.$referen; 
   
       if(!file_exists($path))                    
            @mkdir($path);

        $name_file =  'Acuse COVE_'.$data_cove->cove_edocument.'.pdf';            
        $data = [
            'pk_referencia' => $referen,
            'cove_factura' => $data_cove->cove_factura,
            'imgNameFile' => $name_file,
            'strImageName' => 'Acuse COVE --> '.$data_cove->cove_factura,
            'imgtipodoc' => '000'
        ];
        $exist_acuse = Digital::where('pk_referencia', $referen)->where('imgtipodoc', '000')->count();
        if(!is_null($data) && $exist_acuse == 0)
            $acuse = Digital::insertGetId($data);       
        
        \PDF::loadView('Cove.administration.template_acuse', compact('data_cove','data_firma'))->save($path.'/'.$name_file);

        return $acuse;
    }
    
    
     
}