<?php 

namespace App\Recove;

use App\Recove\Inventory as PedimentoInventory;
use App\Cove\Inventory as CoveInventory;
use App\Cove\Invoice as CoveInvoice;
use App\Recove\Invoice as PedimentoInvoice;
use App\Qore\Company;
use App\Cove\RFCConsult;
use App\Recove\AcuseCove;
use App\Cove\Detail;
use App\Cove\Cove as Cove;
use App\Cove\Seal;
use App\Recove\Pedimento;
use App\Recove\PathDownload;

class ConsultaCove extends Cove{

    public static function searchCove($cove, $referen)
    {
        $seal = Seal::first();
        $exist_cove = Cove::where('cove_edocument', $cove)->first();
        $status = 0;
        $observaciones = '';
        $cadena = '';
        if(count($exist_cove) == 0)
        {
            $id_company = session()->get('company');
            $company = Company::find($id_company);
            $path_plantilla = storage_path().'/xml/cove/'; 
            $path = $path_plantilla.$company->name.'/';
            if(!file_exists($path))
                @mkdir($path);
            $response = ConsultaCove::responseXML($seal, $cove, $path_plantilla, $path); 
            if(file_exists($response))
            {
                $id_cove = ConsultaCove::insertCove($response, $seal, $referen);
                if($id_cove != '')
                {
                    $cove = Cove::find($id_cove);
                    if($company->sector == 3)
                        $automotriz = 1;
                    else
                        $automotriz = 0;

                    if(!is_null($seal))
                    {
                        // Crear cadena original
                        $xml_cadena = Cove::createXML($seal, $cove, 1, $automotriz, $path_plantilla, $company->name); 
                        Cove::createString($xml_cadena, $cove, $seal, $path_plantilla, $company->name);
                        // Crear xml con informacion del COVE
                        $xml_cove = Cove::createXML($seal, $cove, 2, $automotriz, $path_plantilla, $company->name); 
                        if(file_exists($xml_cove))
                        {                            
                            Cove::createAcuse($id_cove, $seal, $company->name, $referen);
                            $pedimento = Pedimento::selectRaw('YEAR(ref_fechapago) as periodo')->where('pk_referencia', $referen)->first();
                            $path_ftp =  $_SERVER['DOCUMENT_ROOT'].'/clientes/ftp/'.$company->name.'/xml/'.$pedimento->periodo.'/'.$cove->pk_referencia;
                            if(!file_exists($path_ftp))                    
                                @mkdir($path_ftp);

                            $file_ftp = $path_ftp.'/cove_'.$cove->pk_item.'.xml';
                            @rename($xml_cove, $file_ftp);
                            $status = 1;
                            $observaciones = 'Insertado correctamente';
                        }
                    }
                }
                else
                {
                    $observaciones = 'El Cove o Adenda no existe, no está firmado o no cuenta con la autorización para consultarlo';
                    $status = 1;
                }
            }
            else
            {
               $observaciones = 'Error al generar cadena original';
            }
        }
        else
        {
            $status = 1;
            $observaciones = 'COVE existente';
        }

        return ['status' => $status, 'observaciones' => $observaciones];
    }
    public static function responseXML($seals, $cove, $path_plantilla, $path)
    {
        $file = $path.'consultacove_'.$cove.'.xml';
        $response_consulta = $path."response_consultacove_".$cove.'.xml'; 
        $xml = simplexml_load_file($path_plantilla."/consultacove.xml");    
        $ns = Cove::namespaces($xml); 
        Cove::tokenSecurity($xml, $ns, $seals);    
        $cadena = "|". $seals->sello_rfc ."|".$cove ."|";        
        $crypttext = Seal::encrypt($cadena, $seals);
        $firma = base64_encode($crypttext); 
        
        foreach ($xml->xpath('//ns2:request') as $peticion)
        { 
            $firmaE = $peticion->children($ns['ns2'])->firmaElectronica;            
            $firmaE->children($ns['ns2'])->certificado = $seals->sello_cer64;
            $firmaE->children($ns['ns2'])->cadenaOriginal = $cadena;
            $firmaE->children($ns['ns2'])->firma = $firma;
            $criterio = $peticion->children($ns['ns2'])->criterioBusqueda;
            $criterio->children($ns['ns2'])->eDocument = $cove;
        }
        $xml->saveXML($file);
        
        if(file_exists($file))
        {
            $envio_consulta = "curl -o " . $response_consulta . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla/ConsultarEdocumentService" . '"' . " -d @" . $file . " https://www.ventanillaunica.gob.mx/ventanilla/ConsultarEdocumentService";
            exec($envio_consulta); 
        } 

        return $response_consulta;
    }

    public static function insertCove($response, $seals, $referen)
    {
        $doc_xml = simplexml_load_file($response);   
        $tipoped = Pedimento::where('pk_referencia', $referen)->first();     
        $id_cove = '';   
        if(is_null($tipoped))
        {
            $pk_tipo = 1; 
            $inv_tipo = 'E';
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
                //RFC de consulta                 
                if(!empty($taginfo->rfcsConsulta))
                {
                    foreach ($taginfo->rfcsConsulta as $rfc){
                        RFCConsult::insert(['cove_factura' => $factura, 'cove_rfcconsulta' => $rfc->rfcConsulta]);
                    }
                }
                //Insert Encabezado
                $tagfactura = $taginfo->facturas->factura; 
                foreach ($tagfactura as $fac) 
                {       
                    if($relacion == 1)
                        $factura = $fac->numeroFactura;               

                    $data_enc = [
                        'pk_tipo' => $pk_tipo,
                        'pk_referencia' => $referen,
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
                        'cove_status' => 3,
                        'cove_captura' => 'VUCEM',
                        'cove_firma' => 'VUCEM',
                        'cove_adenda' => $nadenda,
                        'cove_numadenda' => $noadenda
                    ];

                    if(!is_null($data_enc))
                        $id_cove = Cove::insertGetId($data_enc);  
                    PedimentoInvoice::where('pk_cove',$eDocument)->where('pk_referencia',$referen)->update(['fac_fecha' => $fecha,'pk_factura' => $factura]);
                    //Insertar Facturas - cove_comprobante                      
                    if($relacion != 1)
                    {                         
                        $tagemisor = $taginfo->emisor;
                        $tagdestina = $taginfo->destinatario;  
                    }
                    else
                    {
                        $tagemisor = $children_comp->facturas->factura->emisor;
                        $tagdestina = $children_comp->facturas->factura->destinatario; 
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
                    //$id_cove = Cove::where('cove_edocument',$eDocument)->first();
                    $data_comp = [
                        'pk_item' => $id_cove,
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
                        CoveInvoice::insert($data_comp);                        
                    //Insertar mercancia - cove_mercancia
                    $tagmercancia = $fac->mercancias->mercancia;                         
                    foreach ($tagmercancia as $inv) 
                    {
                        $descripcion = $inv->descripcionGenerica;
                        $umc = $inv->claveUnidadMedida;
                        $moneda = $inv->tipoMoneda;
                        $cantidad = number_format((float)$inv->cantidad,3,'.','');
                        $valor_uni = number_format((float)$inv->valorUnitario, 2, '.', '');
                        $valor_total = number_format((float)$inv->valorTotal, 4, '.', '');
                        $valor_usd = number_format((float)$inv->valorDolares, 4, '.', '');
                        $sec = CoveInventory::where('inv_item', $id_cove)->orderBy('inv_sec', 'desc')->first();   
                        if(is_null($sec))
                            $secuencial = 0;
                        else
                            $secuencial = $sec->inv_sec;                            
                        $secuencial = $secuencial + 1;     
                        $data_merc = [
                            'inv_sec' => $secuencial,
                            'inv_cove' => $eDocument,
                            'inv_factura' => html_entity_decode($factura),
                            'inv_item' => $id_cove,
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
                            $id_merca = CoveInventory::insertGetId($data_merc);

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
                        $tot_merc = CoveInventory::where('inv_item',$id_cove)->count();
                        $exis_inv = PedimentoInventory::where('pk_referencia',$referen)->count();
                        if($exis_inv < $tot_merc || $exis_inv == 0)
                            PedimentoInventory::insert($data_inv);
                        
                        $tagdesesp = $inv->descripcionesEspecificas->descripcionEspecifica; 
                        if(!empty($tagdesesp))
                        {                               
                            foreach ($tagdesesp as $deta)
                            {
                                $marca = $deta->marca;
                                $modelo = $deta->modelo;
                                $subModelo = $deta->subModelo;
                                $serie = $deta->numeroSerie;
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
        return $id_cove;
    }
}