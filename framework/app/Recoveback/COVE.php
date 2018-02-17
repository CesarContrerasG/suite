<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\Recove\Receipt;
use App\Recove\Invoice;
use App\ConnectionDB;
use App\Recove\Agent;
use App\Qore\Company;
use App\Recove\RFCConsulta;
use App\Recove\AcuseCove;
use App\Recove\Detail;

class COVE extends Model{

    protected $connection = 'default';
    protected $table = 'cove_encabezado';
    protected $guarded = ['pk_item'];
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

    public static function consultaCOVE($referen, $cove)
    {
        $seals = Seal::first();
        $exist_cove = COVE::where('cove_edocument',$cove)->first();
        $status = 0;
        $observa = '';
        if(count($exist_cove) == 0)
        {
            $path = base_path().'/public/apps/recove/xml/';   
            $resp_consulta = $path."resp_consultacove_".$cove.'.xml';
            $xml_envio_cove = COVE::generarXML($seals, $cove);             
            $new_cove = $path.'consultacove_'.$cove.'.xml';
            if(file_exists($new_cove))
            {
                $envio_consulta = "curl -o " . $resp_consulta . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla/ConsultarEdocumentService" . '"' . " -d @" . $new_cove . " https://www.ventanillaunica.gob.mx/ventanilla/ConsultarEdocumentService";
                exec($envio_consulta); 
            } 
            if(file_exists($resp_consulta))
            {
                $cadena = COVE::leerXML($resp_consulta,$seals,$referen,$seals->pk_emp);
                if($cadena != '')
                {
                    $status = 1;
                    $observa = 'Insertado correctamente';
                }
                else            
                {
                    $status = 2;
                    $observa = 'El documento solicitado no esta relacionado con el RFC del solicitante.';
                }
            }   
            //unlink($new_cove);
            //unlink($resp_consulta);        

        }
        else
        {
            $get_pedimen = Pedimento::where('pk_referencia',$referen)->first();
            if(is_null($get_pedimen))
            {
                $status = 0;
                $observa = 'Pedimento no registrado '.$referen;
            }
            else
            {
                $anio = date('Y',strtotime($get_pedimen->ref_fechapago));
                if($exist_cove->cove_rfcconsulta == $seals->sello_rfc)
                    $figura = 5;
                else
                    $figura = 1;

                if($get_pedimen->ref_tipo == 1)
                    $inv_tipo = 'E';
                else
                    $inv_tipo = 'S';

                $mercancias = Ware::where('inv_item',$exist_cove->pk_item)->get();
                $tot_merc = count($mercancias);
                foreach($mercancias as $inv)
                {
                    $data_inv = [
                        'pk_referencia' => $referen,
                        'inv_tipo' => $inv_tipo,
                        'inv_fechaes' => $exist_cove->cove_fecha,
                        'inv_factura' => html_entity_decode($inv->inv_factura),
                        'inv_descom' => html_entity_decode($inv->inv_descripcion),
                        'inv_cantumc' => $inv->inv_cantidad,
                        'inv_preuniumc' => $inv->inv_valorunitario,
                        'inv_cantumf' => $inv->inv_cantidad,
                        'inv_preunifac' => $inv->inv_valorunitario,
                        'inv_importeme' => $inv->inv_valortotal,
                        'inv_importeusd' => $inv->inv_valorusd
                    ];
                    $exis_inv = Inventory::where('pk_referencia',$referen)->count();
                    Inventory::insert($data_inv);
                }

                $file_acuse = COVE::crearAcuse($cove,$referen,$figura,$get_pedimen->pk_patente,$anio, $seals->pk_emp);
                $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$seals->pk_emp)->count();
                if($site_ftp > 0)
                {
                    $path_ftp = 'pdf/'.$anio.'/'.$referen.'/';
                    $name_file = $referen.'_Acuse COVE_'.$cove.'.pdf'; 
                    $connect = User::getFTPPath($seals->pk_emp,$path_ftp);
                    if($connect != false)
                    {                   
                        ftp_put($connect, $path_ftp.$name_file,$file_acuse, FTP_BINARY);           
                        ftp_close($connect);
                    }  
                }
                $status = 1;
                $observa = 'COVE existente';
            }
        }
        
        $data = ['status' => $status, 'observa' => $observa];
        
        return $data;
    }
    public static function generarXML($seals,$cove)
    {
        $path = base_path().'/public/apps/recove/xml/';
        $xml = simplexml_load_file($path."consultacove.xml");        
        $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $xml->registerXPathNamespace('ns2', 'http://www.ventanillaunica.gob.mx/ConsultarEdocument/');
        $namespaces = $xml->getNamespaces(true);
        $cadena = "|". $seals->sello_rfc ."|".$cove ."|";
        $pkeyid = openssl_get_privatekey($seals->sello_key64);
        openssl_sign($cadena, $crypttext, $pkeyid);            
        $firma = base64_encode($crypttext); 

        foreach ($xml->xpath('//wsse:UsernameToken') as $token)
        {
            $token->children($namespaces['wsse'])->Username = $seals->sello_rfc;
            $token->children($namespaces['wsse'])->Password = $seals->sello_wsp;
        }
        foreach ($xml->xpath('//ns2:request') as $peticion)
        { 
            $firmaE = $peticion->children($namespaces['ns2'])->firmaElectronica;            
            $firmaE->children($namespaces['ns2'])->certificado = $seals->sello_cer64;
            $firmaE->children($namespaces['ns2'])->cadenaOriginal = $cadena;
            $firmaE->children($namespaces['ns2'])->firma = $firma;
            $criterio = $peticion->children($namespaces['ns2'])->criterioBusqueda;
            $criterio->children($namespaces['ns2'])->eDocument = $cove;
        }

        $xml->saveXML($path.'consultacove_'.$cove.'.xml');
    }

    public static function leerXML($resp, $seals,$referen,$emp)
    {
        $observa_cove = '';
        $cadena = '';
        $path = base_path().'/public/apps/recove/xml/';    
        $cadena_xml = COVE::crearXML($resp,$seals,'','',$referen,$seals->pk_emp);  
        if(file_exists($cadena_xml['file']))
        {
            $xml_file = file_get_contents($cadena_xml['file']);   
            $xslt = new \XSLTProcessor();
            $XSL = new \DOMDocument();
            $XSL->load('Cove02.xsl', LIBXML_NOCDATA);
            $xslt->importStylesheet($XSL);
            $xml = new \DOMDocument();
            $xml->loadXML($xml_file);
            $cadena = $xslt->transformToXML($xml);
            $cadena = substr($cadena, strpos($cadena,'|'));
            $cadena = substr($cadena, 0, strrpos($cadena,'|')+1);
            $cadena = substr($cadena, strpos($cadena,'|')); 
            

            if($cadena != '')
            {
                $pkeyid = openssl_get_privatekey($seals->sello_key64);
                openssl_sign($cadena, $signature, $pkeyid);            
                $firma = base64_encode($signature);
                $cove_xml = COVE::crearXML($resp,$seals,$cadena,$firma,$referen,$emp); 
                $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$emp)->count(); 
                if($site_ftp > 0 && $cove_xml != '')
                {
                    $path_ftp = 'xml/'; 
                    $connect = User::getFTPPath($emp,$path_ftp);
                    if($connect != false)
                    {                   
                        ftp_put($connect, $path_ftp.'cove_xml_'.$cove_xml['cove'].'.xml', $cove_xml['file'],FTP_BINARY);
                        ftp_close($connect);
                    }    
                }
            }
            if(file_exists($cadena_xml['file']))
                unlink($cadena_xml['file']);
        }

        return $cadena;
        
    }
    public static function crearXML($resp,$seals,$cadena,$firma,$referen, $emp)
    {
        $doc_xml = simplexml_load_file($resp);        
        $file = '';
        $eDocument = '';
        $path = base_path().'/public/apps/recove/xml/';
        $pkeyid = openssl_get_privatekey($seals->sello_key64);
        if (openssl_sign($cadena, $signature, $pkeyid))
            $sello = base64_encode($signature) ;
        $split_ref = explode('-', $referen);
        $tipoped = Pedimento::where('pk_aduana',$split_ref[0])->where('pk_patente',$split_ref[1])->where('pk_pedimento',$split_ref[2])->first();
        
        if(is_null($tipoped))
        {
            $pk_tipo = 1; $inv_tipo = 'E';
        }
        else
        {
            if($tipoped->ref_tipo == 1)
            {
                $pk_tipo = 1;
                $inv_tipo = 'E';
            }
            else
            {
                $pk_tipo = 2;
                $inv_tipo = 'S';
            }
        }
        foreach ($doc_xml->xpath('//S:Body') as $respuesta)
        {
            $busqueda = $respuesta->ConsultarEdocumentResponse->response->mensaje;
            if($busqueda == 'La consulta se realizó exitosamente')
            {   
                $status = 1;
                $tagcove =  $respuesta->ConsultarEdocumentResponse->response->resultadoBusqueda->cove;
                $tagadenda = $respuesta->ConsultarEdocumentResponse->response->resultadoBusqueda->adenda;
                $eDocument = $tagcove->eDocument;                   
                if(empty($tagadenda))
                {
                    $taginfo = $tagcove;
                    $nadenda = 0;
                    $noadenda = '';
                }
                else
                {
                    $taginfo = $tagadenda;
                    $nadenda = 1;
                    $noadenda = $tagadenda->numeroAdenda;
                }

                $relacion = $taginfo->relacionFacturas;
                $operacion = $taginfo->tipoOperacion;
                $factura = $taginfo->numeroFacturaRelacionFacturas;                     
                $patente = $taginfo->patentesAduanales->patenteAduanal;                         
                $date_exp = $taginfo->fechaExpedicion;
                $fecha = substr($date_exp, 0, 10);
               
                $observa = $taginfo->observaciones;
                if($cadena == '')
                {
                    $file_xml = simplexml_load_file($path.'cadena_norelacion.xml');
                    foreach ($file_xml->xpath('//UsernameToken') as $token)
                    {
                        $token->children()->Username = $seals->sello_rfc;
                        $token->children()->Password = $seals->sello_wsp;
                    }
                    $path_comp = '//comprobantes';
                    $oxml = '';
                    $file = $path.'cadena_'.$eDocument.'.xml';
                }
                else
                {
                    $file_xml = simplexml_load_file($path.'cove_norelacion.xml');
                    $file_xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
                    $namespaces = $file_xml->getNamespaces(true);
                    foreach ($file_xml->xpath('//wsse:UsernameToken') as $token)
                    {
                        $token->children($namespaces['wsse'])->Username = $seals->sello_rfc;
                        $token->children($namespaces['wsse'])->Password = $seals->sello_wsp;
                    }
                    $path_comp = '//oxml:comprobantes';
                    $oxml = 'oxml:';
                    $path_ftp = dirname(dirname(dirname(dirname(__FILE__)))).'/public_html/clientes/ftp/'.$emp.'/'.'xml/'; 
                    $file = $path_ftp.'cove_xml_'.$eDocument.'.xml';


                }
                    
                foreach ($file_xml->xpath($path_comp) as $comprobante)
                {
                    if($cadena == '')
                        $children_comp = $comprobante->children();
                    else
                        $children_comp = $comprobante->children($namespaces['oxml']);

                    $children_comp->tipoOperacion = $operacion;
                    $children_comp->patenteAduanal = $patente;
                    $children_comp->fechaExpedicion = $fecha;
                    $children_comp->observaciones = $observa;
                    if(!empty($taginfo->rfcsConsulta))
                    {
                        foreach ($taginfo->rfcsConsulta as $rfc){
                            $children_comp->rfcConsulta = $rfc->rfcConsulta; 
                            if($cadena != '')
                                RFCConsulta::insert(['cove_factura' => $factura, 'cove_rfcconsulta' => $rfc->rfcConsulta]);
                        }
                    }
                    $children_comp->tipoFigura = $taginfo->tipoFigura;
                    $children_comp->correoElectronico = '';
                    $children_comp->firmaElectronica->certificado = $seals->sello_cer64;
                    if($cadena != '')
                    {
                        $children_comp->firmaElectronica->cadenaOriginal = $cadena;
                        $children_comp->firmaElectronica->firma = $firma;
                    }
                    if($relacion == 1)
                    {
                          
                        $factura = $fac->numeroFactura; 
                        $children_comp->numeroRelacionFacturas = $factura;                   
                    }
                    else
                    {
                        $children_comp->numeroFacturaOriginal = $factura;  
                    }                   
                    $tagfactura = $taginfo->facturas->factura; 

                    foreach ($tagfactura as $fac) 
                    {       
                        if($cadena != '')                    
                        {
                            $data_enc = [
                                'pk_tipo' => $pk_tipo,
                                'pk_referencia' => html_entity_decode($factura),
                                'cove_patente' => $patente,
                                'cove_factura' => html_entity_decode($factura),
                                'cove_relacion' => $relacion,
                                'cove_subdivision' => $fac->subdivision,
                                'cove_fecha' => $fecha,
                                'cove_certorigen' => $fac->certificadoOrigen,
                                'cove_noexpconfiable' => html_entity_decode($fac->numeroExportadorAutorizado),
                                'cove_observa' => html_entity_decode($observa),
                                'cove_rfcconsulta' => '',
                                'cove_edocument' => $eDocument,
                                'cove_fecha_edocument' => $fecha,
                                'cove_fechafirma' => $fecha,
                                'cove_status' => 1,
                                'cove_captura' => 'VUCEM',
                                'cove_firma' => 'VUCEM',
                                'cove_adenda' => $nadenda,
                                'cove_numadenda' => $noadenda,
                                'cove_cadenaoriginal' => html_entity_decode($cadena),
                                'cove_sellosolicita' => $sello,
                                'cove_sellovucem' => $sello
                            ];
                            if(!is_null($data_enc))
                                COVE::insert($data_enc);
                        }
                        if($relacion != 1)
                        {                          
                            $children_comp->factura->certificadoOrigen = $fac->certificadoOrigen;
                            if(!empty($fac->numeroExportadorAutorizado))
                                 $children_comp->factura->numeroExportadorAutorizado = $fac->numeroExportadorAutorizado;
                                 $children_comp->factura->subdivision = $fac->subdivision;                           
                            $tagemisor = $taginfo->emisor;
                            $tagdestina = $taginfo->destinatario;
                            if($cadena == '')
                            {
                                $children_emisor = $comprobante->children()->emisor;
                                $children_destina = $comprobante->children()->destinatario;
                                $children_mercancia = $comprobante->children()->mercancias;
                            }
                            else
                            {
                                $children_emisor = $comprobante->children($namespaces['oxml'])->emisor;
                                $children_destina = $comprobante->children($namespaces['oxml'])->destinatario;
                                $children_mercancia = $comprobante->children($namespaces['oxml'])->mercancias; 
                            }
                            
                        }
                        else
                        {                           
                            $factura = $fac->numeroFactura; 
                            $children_fac = $children_comp->facturas->addChild('factura');
                            $children_fac->addChild('certificadoOrigen');
                            $children_fac->addChild('numeroExportadorAutorizado');
                            $children_fac->addChild('subdivision');
                            $children_fac->addChild('numeroFactura');
                            $children_emisor = $children_fac->addChild('emisor');
                            $children_destina = $children_fac->addChild('destinatario');
                            $children_mercancia = $children_fac->addChild('mercancias');
                            $children_comp->facturas->factura->certificadoOrigen = $fac->certificadoOrigen;
                            if(!empty($fac->numeroExportadorAutorizado))
                                $children_comp->facturas->factura->numeroExportadorAutorizado = $fac->numeroExportadorAutorizado;
                            $children_comp->facturas->factura->subdivision = $fac->subdivision;   
                            $children_comp->facturas->factura->numeroFactura = $factura;
                            $tagemisor = $children_comp->facturas->factura->emisor;
                            $tagdestina = $children_comp->facturas->factura->destinatario; 
                            //$children_emisor = $children_comp->facturas->factura->emisor;
                            //$children_destina = $children_comp->facturas->factura->destinatario;      
                            //$children_mercancia = $children_comp->facturas->factura->mercancias;                           
                        }
                        $tipo_emisor = $tagemisor->tipoIdentificador;
                        $ident_emisor = $tagemisor->identificacion;
                        $nomb_emisor = $tagemisor->nombre;
                        $calle_emisor = $tagemisor->domicilio->calle;
                        $ext_emisor = $tagemisor->domicilio->numeroExterior;
                        $int_emisor = $tagemisor->domicilio->numeroInterior;
                        $col_emisor = $tagemisor->domicilio->colonia;
                        $loc_emisor = $tagemisor->domicilio->localidad;
                        $mun_emisor = $tagemisor->domicilio->municipio;
                        $ent_emisor = $tagemisor->domicilio->entidadFederativa;
                        $pais_emisor = $tagemisor->domicilio->pais;
                        $cp_emisor = $tagemisor->domicilio->codigoPostal;                    
                        $tipo_destina = $tagdestina->tipoIdentificador;
                        $ident_destina = $tagdestina->identificacion;
                        $nomb_destina =  $tagdestina->nombre;
                        $calle_destina = $tagdestina->domicilio->calle;
                        $ext_destina = $tagdestina->domicilio->numeroExterior;
                        $int_destina = $tagdestina->domicilio->numeroInterior;
                        $col_destina = $tagdestina->domicilio->colonia;
                        $loc_destina = $tagdestina->domicilio->localidad;
                        $mun_destina = $tagdestina->domicilio->municipio;
                        $ent_destina = $tagdestina->domicilio->entidadFederativa;
                        $pais_destina = $tagdestina->domicilio->pais;
                        $cp_destina = $tagdestina->domicilio->codigoPostal;                     


                        $children_emisor->tipoIdentificador = $tipo_emisor;
                        $children_emisor->identificacion = $ident_emisor;                                
                        $children_emisor->nombre = $nomb_emisor;
                        $domicilio_emi = $children_emisor->domicilio;
                        $domicilio_emi->calle = $calle_emisor;
                        $domicilio_emi->numeroExterior = $ext_emisor;
                        $domicilio_emi->numeroInterior = $int_emisor;
                        $domicilio_emi->colonia = $col_emisor;
                        $domicilio_emi->localidad = $loc_emisor;
                        $domicilio_emi->municipio = $mun_emisor;
                        $domicilio_emi->entidadFederativa = $ent_emisor;
                        $domicilio_emi->pais = $pais_emisor;
                        $domicilio_emi->codigoPostal = $cp_emisor;
                        if($cadena == '')
                            $children_destina = $comprobante->children()->destinatario;
                        else
                            $children_destina = $comprobante->children($namespaces['oxml'])->destinatario;
                        $children_destina->tipoIdentificador = $tipo_destina;
                        $children_destina->identificacion = $ident_destina;
                        $children_destina->nombre = $nomb_destina;
                        $domicilio_des = $children_destina->domicilio;
                        $domicilio_des->calle = $calle_destina;
                        $domicilio_des->numeroExterior = $ext_destina;
                        $domicilio_des->numeroInterior = $int_destina;
                        $domicilio_des->colonia = $col_destina;
                        $domicilio_des->localidad = $loc_destina;
                        $domicilio_des->municipio = $mun_destina;
                        $domicilio_des->entidadFederativa = $ent_destina;
                        $domicilio_des->pais = $pais_destina;
                        $domicilio_des->codigoPostal = $cp_destina;
                        
                        if($cadena != '')                    
                        {
                            $id_cove = COVE::where('cove_edocument',$eDocument)->first();
                            $data_comp = [
                                'pk_item' => $id_cove->pk_item,
                                'inv_cove' => $eDocument,
                                'inv_factura' => html_entity_decode($factura),
                                'inv_fecha' => $fecha,
                                'inv_subdivision' => $fac->subdivision,
                                'inv_certorigen' => $fac->certificadoOrigen,
                                'inv_noexpconfiable' => html_entity_decode($fac->numeroExportadorAutorizado),
                                'emisor_tipoid' => $tipo_emisor,
                                'emisor_clave' => html_entity_decode($ident_emisor),
                                'emisor_identificador' => html_entity_decode($ident_emisor),
                                'emisor_nombre' => html_entity_decode($nomb_emisor),
                                'emisor_calle' => html_entity_decode($calle_emisor),
                                'emisor_noext' => $ext_emisor,
                                'emisor_noint' => $int_emisor,
                                'emisor_col' => html_entity_decode($col_emisor),
                                'emisor_localidad' => html_entity_decode($loc_emisor),
                                'emisor_mpo' => html_entity_decode($mun_emisor),
                                'emisor_edo' => html_entity_decode($ent_emisor),
                                'emisor_pais' => $pais_emisor,
                                'emisor_cp' => $cp_emisor,
                                'dest_tipoid' => $tipo_destina,
                                'dest_clave' => html_entity_decode($ident_destina),
                                'dest_identificador' => html_entity_decode($ident_destina),
                                'dest_nombre' => html_entity_decode($nomb_destina),
                                'dest_calle' => html_entity_decode($calle_destina),
                                'dest_noext' => $ext_destina,
                                'dest_noint' => $int_destina,
                                'dest_col' => html_entity_decode($col_destina),
                                'dest_localidad' => html_entity_decode($loc_destina),
                                'dest_mpo' => html_entity_decode($mun_destina),
                                'dest_edo' => html_entity_decode($ent_destina),
                                'dest_pais' => $pais_destina,
                                'dest_cp' => $cp_destina
                            ];
                            if(!is_null($data_comp))
                                Receipt::insert($data_comp);
                        }
                         
                        $tagmercancia = $fac->mercancias->mercancia; 
                                                                     
                        foreach ($tagmercancia as $inv) 
                        {
                            $children_mercancia = $comprobante->addChild($oxml.'mercancias');
                            $descripcion = $inv->descripcionGenerica;
                            $umc = $inv->claveUnidadMedida;
                            $moneda = $inv->tipoMoneda;
                            $cantidad = number_format((float)$inv->cantidad,3,'.','');
                            $valor_uni = number_format((float)$inv->valorUnitario, 2, '.', '');
                            $valor_total = number_format((float)$inv->valorTotal, 4, '.', '');
                            $valor_usd = number_format((float)$inv->valorDolares, 4, '.', '');
                            $children_mercancia->addChild($oxml.'descripcionGenerica',htmlspecialchars($descripcion));
                            $children_mercancia->addChild($oxml.'claveUnidadMedida',$umc);
                            $children_mercancia->addChild($oxml.'tipoMoneda',$moneda);
                            $children_mercancia->addChild($oxml.'cantidad', $cantidad);
                            $children_mercancia->addChild($oxml.'valorUnitario', $valor_uni);
                            $children_mercancia->addChild($oxml.'valorTotal', $valor_total);
                            $children_mercancia->addChild($oxml.'valorDolares',$valor_usd);
                            if($cadena != '')                    
                            {
                                $data_merc = [
                                    'inv_cove' => $eDocument,
                                    'inv_factura' => html_entity_decode($factura),
                                    'inv_item' => $id_cove->pk_item,
                                    'inv_descripcion' => html_entity_decode($descripcion),
                                    'inv_descove' => html_entity_decode($descripcion),
                                    'inv_oma' => $umc,
                                    'inv_cantidad' => $cantidad,
                                    'inv_valorunitario' => $valor_uni,
                                    'inv_valortotal' => $valor_total,
                                    'inv_moneda' => $moneda,
                                    'inv_valorusd' => $valor_usd
                                ];
                                if(!is_null($data_merc))
                                    $id_merca = Ware::insertGetId($data_merc);

                                $data_inv = [
                                    'pk_referencia' => $referen,
                                    'inv_tipo' => $inv_tipo,
                                    'inv_fechaes' => $fecha,
                                    'inv_factura' => html_entity_decode($factura),
                                    'inv_descom' => html_entity_decode($descripcion),
                                    'inv_cantumc' => $cantidad,
                                    'inv_preuniumc' => $valor_uni,
                                    'inv_cantumf' => $cantidad,
                                    'inv_preunifac' => $valor_uni,
                                    'inv_importeme' => $valor_total,
                                    'inv_importeusd'  => $valor_usd
                                ];
                                $tot_merc = Ware::where('inv_item',$id_cove->pk_item)->count();
                                $exis_inv = Inventory::where('pk_referencia',$referen)->count();
                                if($exis_inv < $tot_merc)
                                    Inventory::insert($data_inv);
                            }
                                
                            $children_mercancia->addChild($oxml.'descripcionesEspecificas');
                            $tagdesesp = $inv->descripcionesEspecificas->descripcionEspecifica; 
                            if(!empty($tagdesesp))
                            {                               
                                foreach ($tagdesesp as $deta)
                                {
                                    $marca = $deta->marca;
                                    $modelo = $deta->modelo;
                                    $subModelo = $deta->subModelo;
                                    $serie = $deta->numeroSerie;
                                    if($cadena == '')
                                        $especificas = $children_mercancia->children()->descripcionesEspecificas;
                                    else
                                        $especificas = $children_mercancia->children($namespaces['oxml'])->descripcionesEspecificas;
                                    $especificas->addChild($oxml.'marca',htmlspecialchars($marca));
                                    $especificas->addChild($oxml.'modelo', htmlspecialchars($modelo));
                                    $especificas->addChild($oxml.'subModelo',htmlspecialchars($subModelo));
                                    $especificas->addChild($oxml.'serie', htmlspecialchars($serie));
                                    if(isset($especificas) &&  $cadena != '')
                                    {
                                        $data_detail = [
                                            'inv_cove' => html_entity_decode($factura),
                                            'inv_item' => $id_merca,
                                            'inv_marca' => html_entity_decode($marca),
                                            'inv_modelo' => html_entity_decode($modelo),
                                            'inv_submodelo' => html_entity_decode($subModelo),
                                            'inv_noserie' => html_entity_decode($serie)
                                        ];
                                        if(!is_null($data_detail))
                                            Detail::insert($data_detail);
                                    }
                                }
                            }
                            
                        }
                            
                    }
                }

                $file_xml->saveXML($file);  
                $get_pedimen = Pedimento::where('pk_referencia',$referen)->first();
                $anio = date('Y',strtotime($get_pedimen->ref_fechapago));

                if($cadena != '')
                {
                    $file_acuse = COVE::crearAcuse($eDocument,$referen,$taginfo->tipoFigura,$patente,$anio,$emp);        
                    $site_ftp = \DB::connection('mysql')->table('config_dir')->where('company',$emp)->count();
                    if($site_ftp > 0)
                    {
                        $path_ftp = 'pdf/'.$anio.'/'.$referen.'/';
                        $name_file = $referen.'_Acuse COVE_'.$eDocument.'.pdf'; 
                        $connect = ConnectioDB::getFTPPath($emp,$path_ftp);
                        if($connect != false)
                        {                   
                            ftp_put($connect, $path_ftp.$name_file,$file_acuse, FTP_BINARY);           
                            ftp_close($connect);
                        }  
                    }
                }
            }   
        }
        return ['file' => $file, 'cove' => $eDocument];
    }

    public static function crearAcuse($eDocument,$referen,$figura,$patente,$periodo, $emp)
    {
        $data_cove = COVE::where('cove_edocument',$eDocument)->first();

        if($figura != 1)
        {
            $data_firma = Company::select('name','identif as rfc')->where('username',$emp)->first();
        }
        else
        {
            $data_firma = Agent::select('age_razon as name','age_rfc as rfc')->where('pk_age',$patente)->first();
            if(is_null($data_firma))
            	$data_firma = Company::select('name','identif as rfc')->where('username',$emp)->first();
        }

        $path_ftp = dirname(dirname(dirname(dirname(__FILE__)))).'/public_html/clientes/ftp/'.$emp.'/'.'pdf/'.$periodo.'/'.$referen.'/';      

        Invoice::where('pk_cove',$data_cove->cove_edocument)->where('pk_referencia',$referen)->update(['fac_fecha' => $data_cove->cove_fecha,'pk_factura' => $data_cove->cove_factura]);
                       
        $data = [
            'pk_referencia' => $referen,
            'cove_factura' => $data_cove->cove_factura,
            'imgNameFile' => $referen.'_Acuse COVE_'.$eDocument.'.pdf',
            'strImageName' => 'Acuse COVE --> '.$data_cove->cove_factura,
            'imgtipodoc' => '000'
        ];
        if(!is_null($data))
            AcuseCove::insert($data);
        
        
        $pdf = \PDF::loadView('Recove.template_acuse', compact('data_cove','data_firma'))->save($path_ftp.$referen.'_Acuse COVE_'.$eDocument.'.pdf');
        $file_acuse = $path_ftp.$referen.'_Acuse COVE_'.$eDocument.'.pdf';
        
        return $file_acuse;
    }

}