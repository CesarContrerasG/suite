<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\Qore\CPedimen;
use App\ConnectionDB;
use App\Recove\BitacoraPedimento;
use App\Recove\BitacoraCove;
use App\Qore\Company;

class Pedimento extends Model{

    protected $connection = 'default';
    protected $table = 'optr01';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';

    }

    public static function searchList($seals,$aduana,$fecha)
    {
        $path = base_path().'/public/apps/recove/xml/'; 

        $new_file = $path.'listarpedimentos_'.$aduana.'_'.$fecha.'.xml';
        $resp = $path.'resp_pedimentos_'.$aduana.'_'.$fecha.'.xml';
        //=====================  CONSULTA DE LISTADO ====================================================
        Pedimento::generarXML($seals,$aduana,$fecha,$new_file);                
        if(file_exists($new_file))
        {  
            $send_xml = "curl -o " . $resp . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ListarPedimentosService" . '"' . " -d @".$new_file." https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ListarPedimentosService";
            exec($send_xml);
           // unlink($new_file);                    
        }

        //========================================================== RESPUESTA LISTADO ==========================================================
        if(file_exists($resp))
        {
            //=============================== LEER LISTADO DE PEDIMENTOS =======================================
            $list = Pedimento::readList($resp); 

            if(!empty($list))                            
            {
                for($j=0; $j<count($list); $j++)
                {  
                    $cadena = explode('|',$list[$j]); 
                    $patente  = $cadena[0];
                    $pedimento = $cadena[1];  

                    $exis_ped = BitacoraPedimento::where('aduana',$aduana)->where('patente',$patente)
                            ->where('pedimento',$pedimento)->count();
                    if($exis_ped == 0)                         
                        BitacoraPedimento::insert(['aduana' => $aduana,'patente' => $patente, 'pedimento' => $pedimento,'fecha' => $fecha]);
                }
            }             
            
        }        
        //unlink($resp); 
    }
    public static function generarXML($seals,$referen,$date,$file)
    {
        $ref = explode('-', $referen);
        if($date != '')
            $platilla = 'listarpedimentos.xml';
        else
            $platilla = 'consultarpedimentocompleto.xml';
		$xml = simplexml_load_file(base_path().'/public/apps/recove/xml/'.$platilla);		
        $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');

        $namespaces = $xml->getNamespaces(true);
        foreach ($xml->xpath('//wsse:UsernameToken') as $token)
        {
            $token->children($namespaces['wsse'])->Username = $seals->sello_rfc;
            $token->children($namespaces['wsse'])->Password = $seals->sello_wsp;
        }
        if($date != '')
            Pedimento::setList($ref[0],$seals->sello_rfc,$date,$xml,$namespaces);
        else
            Pedimento::setComplete($ref[0],$ref[1],$ref[2],$xml,$namespaces);
            

		$xml->saveXML($file);
    }

    public static function setList($aduana,$rfc,$date,$xml,$namespaces)
    {
        foreach ($xml->xpath('//lis:peticion') as $peticion)
        { 
            $peticion->children($namespaces['lis'])->aduana = $aduana;
            $peticion->children($namespaces['lis'])->rfc = $rfc;
            $peticion->children($namespaces['lis'])->fechaInicio = $date;
            $peticion->children($namespaces['lis'])->fechaFin = $date;
        }
    }

    public static function setComplete($aduana,$patente,$pedimento,$xml,$namespaces)
    {
        foreach ($xml->xpath('//con:peticion') as $peticion)
        { 
            $peticion->children($namespaces['com'])->aduana = $aduana;
            $peticion->children($namespaces['com'])->patente = $patente;
            $peticion->children($namespaces['com'])->pedimento = $pedimento;
        }
    }

    public static function readList($resp)
    {
        $array_busqueda = [];
        $xml = simplexml_load_file($resp);
        $namespaces = $xml->getNamespaces(true);
        if(!empty($xml->children($namespaces['S'])))
        {
            foreach($xml->children($namespaces['S'])->Body as $body) 
            {                
                foreach($body->children($namespaces['ns2'])->consultarPedimentosRespuesta as $content)
                {   
                    if($content->children($namespaces['ns3'])->tieneError == 'false')
                    {
                        for($i=0; $i<count($content); $i++)
                        {
                            if($content->children($namespaces['ns3'])->tieneError == 'false')
                            {              
                                $child = $content->children($namespaces['ns2'])->pedimento[$i]->children($namespaces['ns2']);           
                                $patente = $child->petente;
                                $pedimento = $child->numeroDocumentoAgente;
                                $busqueda = $patente."|".$pedimento;                         
                            }
                            else
                            {
                                $busqueda = '';
                            }
                            array_push($array_busqueda,$busqueda);
                        }  
                    }                               
                }
            }
        } 

        return $array_busqueda;
    }

    public static function getFields($content,$referen)
    {
        $head = $content->pedimento->encabezado;        
        $typeop = $head->tipoOperacion->clave;
        $clave = $head->claveDocumento->clave;
        $dest = $head->destino->clave;
        $tc = $head->tipoCambio;
        $weight = $head->pesoBruto;
        $aduanaeo = $head->aduanaEntradaSalida->clave;
        $tranOut = $head->medioTrasnporteSalida->clave;
        $tranArr = $head->medioTrasnporteArribo->clave;
        $tranEnt = $head->medioTrasnporteEntrada->clave;
        $valAduana = $head->valorAduanalTotal;
        $valDolar = (float)$valAduana / (float)$tc;
        $payment = $head->valorComercialTotal;
        $secure = $content->pedimento->importadorExportador->seguros;
        $charter = $content->pedimento->importadorExportador->fletes;
        $pack = $content->pedimento->importadorExportador->embalajes;
        $otherin = $content->pedimento->importadorExportador->incrementables;
        $datePay = NULL;
        $dateEnt = NULL;
        $dateOut = $content->pedimento->importadorExportador->fechas;

        foreach ($dateOut as $date) 
        {
            $type = $date->tipo->clave;
            if($type == 2)
                $datePay = $date->fecha;
            else
                $dateEnt = $date->fecha;
        }

        $cash = $content->pedimento->importadorExportador->efectivo;
        $other = $content->pedimento->importadorExportador->otros;
        $total = $content->pedimento->importadorExportador->total;
        $observation = $content->pedimento->observaciones;        
        $identifi = $content->pedimento->identificadores;  
        $ref = explode('-', $referen);

        $caof02 = CPedimen::where('cpe_clave',$clave)->first();
        if($typeop == 1)
        {
            $regimen = $caof02->cpe_regi;
            $opera  = 'IMP';
        }
        else
        {
            $regimen = $caof02->cpe_rege;
            $opera = 'EXP';
        }

        

        //============== Insertar Encabezado de Pedimento ===============
        $data = ['pk_referencia' => $referen,'pk_patente' => $ref[1],'pk_pedimento' => $ref[2],'pk_aduana' => $ref[0],'ref_tipo' => $typeop,'ref_tipodoc' => 'P','ref_tipope'=> $opera,'ref_pedimento'=>$ref[1].'-'.$ref[2],'ref_clave' => $clave,'ref_regimen' => $regimen,'ref_destino' => $dest,'ref_tipocambio' => $tc,'ref_pesokg' => $weight,'ref_aduanaes' => $aduanaeo,'ref_transport1' => $tranEnt,'ref_transport2' => $tranArr,'ref_transport3' => $tranOut,'ref_valorusd' => $valDolar,'ref_valoradu' => $valAduana,'ref_preciopag' => $payment,'ref_seguros' => $secure,'ref_fletes' => $charter,'ref_embalajes' => $pack,'ref_otrosinc' => $otherin,'ref_fechapago' => $datePay,'ref_fechaentra' => $dateEnt,'ref_fechaext' =>NULL,'ref_fechapre' => NULL,'ref_fechact' => NULL,'ref_fechar1' => NULL,'ref_fechavence' => NULL, 'ref_efectivo' => $cash,'ref_otros' => $other,'ref_total' => $total,'ref_observa' => $observation,'origen' => 1];

        return $data;
    }

    public static function consultaPedimento($id)
    {
        $seals = Seal::first();        
        $bitacora = BitacoraPedimento::find($id);
        $path = base_path().'/public/apps/recove/xml/';    
        $status = 0;
        $observaciones = 'Ocurrio un error de conexión';
        $observa_fac = '';
        $optr01 = Pedimento::where('pk_aduana',$bitacora->aduana)->where('pk_patente',$bitacora->patente)->where('pk_pedimento',$bitacora->pedimento)->count();
        $referen = $bitacora->aduana.'-'.$bitacora->patente.'-'.$bitacora->pedimento;
        $periodo = date('Y',strtotime($bitacora->fecha));
        $path_ftp = dirname(dirname(dirname(dirname(__FILE__)))).'/public_html/clientes/ftp/'.$seals->pk_emp.'/'.'pdf/'.$periodo.'/'.$referen.'/'; 
        if (!file_exists($path_ftp)) 
            @mkdir($path_ftp, 0777, true);
        
        if($optr01 == 0)        
        {
            $file = 'consultarpedimentocompleto';   
            $new_file = $path.$file.'_'.$referen.'.xml';            
            $resp_com =  $path."resp_complete_".$referen.".xml";
            //================================ CONSULTA PEDIMETO ========================================== 
            Pedimento::generarXML($seals,$referen,'',$new_file);  
            if(file_exists($new_file))
            {                                    
                $send_xml = "curl -o " . $resp_com . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPedimentoCompletoService" . '"' . " -d @" . $new_file . " https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPedimentoCompletoService";
                exec($send_xml);
            } 
            if(file_exists($resp_com))
            {
                $xml = simplexml_load_file($resp_com);
                $namespaces = $xml->getNamespaces(true);
                if(!empty($xml->children($namespaces['S'])))
                {
                    foreach($xml->children($namespaces['S'])->Body as $body)
                    {
                        foreach($body->children($namespaces['ns2'])->consultarPedimentoCompletoRespuesta as $content)
                        {
                            if($content->children($namespaces['ns3'])->tieneError == 'false')
                            {
                                $opera = $content->numeroOperacion;
                                if(!isset($content->children($namespaces['ns2'])->pedimento->children($namespaces['ns2'])->previoConsolidado))
                                {
                                    $dataH = Pedimento::getFields($content,$referen);
                                    $head = Pedimento::insert($dataH);   
                                    //unlink($resp_com);
                                    /*if($head)
                                    {*/
                                        $status = 1;                                        
                                        $rates = $content->pedimento->tasas;       
                                        foreach ($rates as $rate) 
                                        { 
                                            $dataC = Contribution::getFields($rate,$referen);
                                            if(!is_null($dataC))
                                                Contribution::insert($dataC);                   
                                        }
                                        $identif = $content->pedimento->identificadores;  
                                        foreach ($identif as $ide)
                                        {
                                            foreach($ide->identificadores as $key)
                                            {
                                                $dataId = Identifier::getFields($key,$referen,$seals->pk_emp);
                                                if(!is_null($dataId))
                                                    Identifier::insert($dataId);
                                            }
                                        }                                 
                                        $invoice = $content->pedimento->facturas;
                                        $total_item = 0;
                                        if(!isset($invoice) || is_null($invoice))
                                        {                                            
                                            BitacoraCove::insert(['bitacora_pedimento_id' => $id,'cove' => '','status' => 1,'observaciones' => 'El pedimento no cuenta con COVE']);
                                        }
                                        else
                                        {
                                            foreach ($invoice as $inv) 
                                            {
                                            	$clave = $content->pedimento->encabezado->claveDocumento->clave; 
                                            	$copera = $content->pedimento->encabezado->tipoOperacion->clave;
                                            	$is_cove = substr($inv->numero, 0, 4); 
                                            	$dataI = Invoice::getFields($inv,$content,$referen);
                                            	$exis_cove = BitacoraCove::where('bitacora_pedimento_id',$id)->where('cove',$inv->numero)->count();

                                            	if($clave == 'A1' && $copera == 2) 
                                            	{      
													if(!is_null($dataI))
	                                                    $receipt = Invoice::insert($dataI);	
	                                                if($is_cove == 'COVE')
	                                                {
	                                                	if($exis_cove == 0)  
                                                    		BitacoraCove::insert(['bitacora_pedimento_id' => $id,'cove' => $inv->numero,'status' => 0]);
	                                                }
                                            	}
                                            	else
                                            	{
                                            		if(!is_null($dataI))
	                                                    $receipt = Invoice::insert($dataI);	 
	                                                if($exis_cove == 0)  
                                                    	BitacoraCove::insert(['bitacora_pedimento_id' => $id,'cove' => $inv->numero,'status' => 0]);                                               
                                            	}
                                            }
                                            	
                                            $partidas = '';
                                            $items = $content->pedimento->partidas; 
                                            $total_item = count($items);
                                            BitacoraPedimento::where('id',$id)->update(['tpartidas' => $total_item,'operacion' => $opera]);
                                            foreach($items as $item)         
                                            {                                             
                                               Pedimento::consultaPartida($item,$id);
                                            }

                                            
                                        }
                                        $toptr03 = Item::where('pk_referencia',$referen)->count();
                                        if($total_item == $toptr03)
                                        {
                                            $status = 2;    
                                            $observaciones = 'Pedimento recuperado';
                                        }
                                        else
                                        {
                                        	$observaciones = 'Error al recuperar partida';
                                        }

                                          
                                    //}
                                }
                                else
                                {
                                    $status = 2;
                                    $observaciones = 'Previo Consolidado';
                                }
                            }
                        }  
                    }
                }                
            }
            //unlink($new_file);
            //unlink($resp_com);
        }
        else
        {          
            $ed_seceped = Identifier::where('pk_referencia',$referen)->where('clave_des','ED')->get();
            foreach ($ed_seceped as $edped) 
            {
                $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('referencia',$referen)->where('edocument',$edped->descripcion)->count();
                if($num_ed == 0)
                    \DB::connection('mysql')->table('bitacora_ED')->insert(['referencia' => $referen,'edocument' => $edped->descripcion,'empresa' => $seals->pk_emp,'periodo' => $periodo]);
            }

            $ed_secepar = IdentifierItem::where('pk_referencia',$referen)->where('clave_des','ED')->get();
            foreach ($ed_secepar as $edpar) 
            {
                $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('referencia',$referen)->where('edocument',$edpar->descripcion)->count();
                if($num_ed == 0)
                    \DB::connection('mysql')->table('bitacora_ED')->insert(['referencia' => $referen,'edocument' => $edpar->descripcion,'empresa' => $seals->pk_emp,'periodo' => $periodo]);
            }

            $receipt = Invoice::where('pk_referencia',$referen)->select('pk_cove','pk_factura')->get();
            if(!is_null($receipt))
            {
                foreach ($receipt as $fac) 
                {
                    $num_cove = '';
                    $pos1 = strpos($fac->pk_cove, 'COVE');
                    if($pos1 === false)
                    {
                        $pos2 = strpos($fac->pk_factura, 'COVE');
                        if($pos2 !== false)
                            $num_cove = $fac->pk_factura;
                    }
                    else
                    {
                        $num_cove = $fac->pk_cove;
                    } 

                    if($num_cove != '')
                    {
                        $exis_cove = BitacoraCove::where('cove',$num_cove)->where('bitacora_pedimento_id',$bitacora->id)->count();
                        if($exis_cove == 0)  
                            BitacoraCove::insert(['bitacora_pedimento_id' => $bitacora->id,'cove' => $num_cove,'status' => 0]);      
                    }  
                    else
                    {
                       $status = 2;
                       $observa_fac = 'El pedimento no cuenta con COVE';  
                       BitacoraCove::insert(['bitacora_pedimento_id' => $bitacora->id,'cove' => '','status' => $status,'observaciones' => $observa_fac]); 
                    }                                
                }
            }
            else
            {
                $status = 2;
                $observa_fac = 'Pedimento no cuenta con factura';  
                BitacoraCove::insert(['bitacora_pedimento_id' => $bitacora->id,'cove' => '','status' => $status,'observaciones' => $observa_fac]);                 
            }
            
            $observaciones = 'Pedimento ya registrado';
            $status = 2;
        }
        BitacoraPedimento::where('id',$id)->update(['observaciones' => $observaciones,'status' => $status]);
    } 

    public static function consultaPartida($item,$id_bit)
    {
        $seals = Seal::first();   
        $bitacora = BitacoraPedimento::find($id_bit);        
        $path = base_path().'/public/apps/recove/xml/';    
        $new_file = $path.'consultarpartida_'.$seals->sello_rfc.'.xml';
        $referen = $bitacora->aduana.'-'.$bitacora->patente.'-'.$bitacora->pedimento;
        $resp_item =  $path."resp_item_".$item."_".$referen."_".$seals->sello_rfc.".xml";
        //$bit = BitacoraPedimento::where('id',$id)->first();
        $search_optr03 = Item::where('pk_referencia',$referen)->where('pk_sec',$item)->count();
        if($search_optr03 == 0)
        {
            Item::generarXML($seals,$item,$bitacora->aduana,$bitacora->patente,$bitacora->pedimento,$bitacora->operacion);                
            if(file_exists($new_file))
            {
                $send_xml = "curl -o " . $resp_item . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPartidaService" . '"' . " -d @" . $new_file . " https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPartidaService";
                exec($send_xml);
                //unlink($new_file);
            }
            if(file_exists($resp_item))
            {
                $xml = simplexml_load_file($resp_item);
                $namespaces = $xml->getNamespaces(true); 
                $ns = '';
                if(array_key_exists("ns9", $namespaces))
                {
                    $ns = $namespaces['ns9'];
                    if(array_key_exists("ns8", $namespaces))
                        $nschild = $namespaces['ns8'];
                }
                else
                {
                    if(array_key_exists("ns3", $namespaces))
                    {
                        $ns = $namespaces['ns3'];
                        if(array_key_exists("ns2", $namespaces))
                            $nschild = $namespaces['ns2'];
                    }
                }
                if($ns != '')
                {
                    if(!empty($xml->children($namespaces['S'])))
                    {
                        foreach($xml->children($namespaces['S'])->Body as $body) 
                        {
                            foreach($body->children($ns)->consultarPartidaRespuesta as $content)
                            {   
                                if($content->children()->tieneError == 'false')
                                {
                                    $status = 1;
                                    $itemChild = $content->partida->children($nschild);
                                    $dataIt = Item::getFields($itemChild,$referen);
                                    if(!is_null($dataIt))
                                        Item::insert($dataIt);                                                                       
                                    $gravamen = $itemChild->gravamenes;
                                    foreach ($gravamen as $grav) 
                                    {
                                        $dataG = Gravamen::getFields($grav,$dataIt['pk_sec'],$referen);
                                        if(!is_null($dataG))
                                            Gravamen::insert($dataG);
                                    }
                                    $iditem = $itemChild->identificadores;
                                    foreach ($iditem as $idxp) 
                                    {
                                        $dataIItem = IdentifierItem::getFields($idxp,$dataIt['pk_sec'],$referen,$seals->pk_emp);
                                        if(!is_null($dataIItem))
                                            IdentifierItem::insert($dataIItem);
                                    }
                                }
                                else
                                {                      
                                    $status = 0;
                                }  
                            }
                        }
                    }
                }
                else
                {
                    $status = 0;
                }
                //unlink($resp_item);
            }
            else
            {
                $status = 0;
            } 
        }
        else
        {
            $status = 1;            
        } 
      
        
		if($status == 0)
        	BitacoraPedimento::where('id',$id_bit)->update(['observaciones' => 'Error al recuperar partida '.$item, 'status' => 1]);
        else
        	BitacoraPedimento::where('id',$id_bit)->update(['observaciones' => 'Pedimento recuperado','status' => 2]);
  
    }
}