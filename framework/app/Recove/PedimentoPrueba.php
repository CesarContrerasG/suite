<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Recove\BitacoraPedimento;
use App\Recove\BitacoraCove;
use App\Cove\Seal;
use App\Qore\CPedimento;

class PedimentoPrueba extends Model{

    protected $connection = 'default';
    protected $table = 'optr01';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function uploadList($file)
    {       
        $fh = fopen($file, "r"); 
        $firstline = true;
        while ($data = fgetcsv ( $fh)) 
        {
            if (!$firstline) 
            {
                $dateInput = explode('/',$data[3]);
                if(count($dateInput) > 2)
                {
                    $date = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
                    $exis_ped = BitacoraPedimento::where('aduana',$data[0])->where('patente',$data[1])->where('pedimento',$data[2])->count();
                    if($exis_ped == 0)                         
                        BitacoraPedimento::insert(['aduana' => $data[0],'patente' => $data[1], 'pedimento' => $data[2],'fecha' => $date, 'status' => 0]);
                }
            }
            $firstline = false;
        }
        fclose($fh);  
    }
    //======================== LISTADO DE BUSQUEDA =====================================
    public static function searchList($aduana, $date, $start, $rfc, $company)
    {         
    //    $company = auth()->user()->company_name;
        $path = storage_path() . '/xml/pedimento/'. $company. '/';   

        if(!file_exists($path))
            mkdir($path);         
        //=====================  CONSULTA DE LISTADO ================================
        $time =  microtime(true) - $start;
        if($time > 50000000)
            return 0;

        $response = PedimentoPrueba::requestPedimentoXML($rfc, $aduana, $date, $path);   
        echo $response;      
        if(file_exists($response))
        {
            $result = 0;
            while ($result == 0)
                $result = PedimentoPrueba::readList($response, $aduana, $date, $company);

        }

        //return $result; 
        //unlink($new_file);                          
        //unlink($resp);
    }
    
    public static function requestPedimentoXML($rfc, $aduana, $date, $path)
    {
        $path_xml = storage_path() . '/xml/pedimento';
        $file = $path . 'listarpedimentos_'. $aduana . '_'. $date. '.xml';
        $response = $path .'response_list_'. $aduana . '_'. $date. '.xml';
        $xml = simplexml_load_file($path_xml .'/listarpedimentos.xml');	
        PedimentoPrueba::setUserToken($xml);
        PedimentoPrueba::setParams($aduana, $rfc, $date, $xml);
        $xml->saveXML($file);
        if(file_exists($file))
        {  
            $send_xml = "curl -o " . $response . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ListarPedimentosService" . '"' . " -d @".$file." https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ListarPedimentosService";
            exec($send_xml);        
        }

        return $response;
    }

    public static function setUserToken($xml)
    {
        $seal = Seal::first();
        $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $namespaces = $xml->getNamespaces(true);        
        foreach ($xml->xpath('//wsse:UsernameToken') as $token)
        {
            $token->children($namespaces['wsse'])->Username = $seal->sello_rfc;
            $token->children($namespaces['wsse'])->Password = $seal->sello_wsp;
        }
    }

    public static function setParams($aduana, $rfc, $date, $xml)
    {
        $namespaces = $xml->getNamespaces(true);
        foreach ($xml->xpath('//lis:peticion') as $peticion)
        { 
            $peticion->children($namespaces['lis'])->aduana = $aduana;
            $peticion->children($namespaces['lis'])->rfc = $rfc;
            $peticion->children($namespaces['lis'])->fechaInicio = $date;
            $peticion->children($namespaces['lis'])->fechaFin = $date;
        }
    }

    public static function readList($response, $aduana, $date, $company)
    {
        $xml = simplexml_load_file($response);
        $namespaces = $xml->getNamespaces(true);
        //$company = auth()->user()->company_name;
        if(!empty($xml->xpath('//S:Envelope')))
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
                                $exist = BitacoraPedimento::where('aduana', $aduana)->where('patente', $patente)->where('pedimento', $pedimento)->count();
                                if($exist == 0)
                                {
                                    $periodo = date('Y',strtotime($date));
                                    $referen = $aduana .'-'.$patente.'-'.$pedimento;
                                    $path_ftp =  dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/clientes/ftp/'.$company.'/'.'pdf/'.$periodo.'/'.$referen.'/'; 
                           
                                    if (!file_exists($path_ftp)) 
                                        @mkdir($path_ftp, 0777, true);
                                    BitacoraPedimento::insert(['aduana' => $aduana,'patente' => $patente, 'pedimento' => $pedimento,'fecha' => $date]);                      
                                }
                            }
                            else
                            {
                                return 0;
                            }                            
                        }  
                    }    
                    else
                    {
                        $mensaje = $content->children($namespaces['ns3'])->error->children($namespaces['ns3'])->mensaje;
                        if($mensaje != 'No hay información para la búsqueda solicitada')
                            return 0;
                    }                           
                }
            }
        } 

        return 1;
    }
    //////////////////////////////////////////////////////////////////////////////////
    public static function requestCompleteXML($bitacora, $company)
    {
        //$company = auth()->user()->company_name;              
        $path_xml = storage_path() . '/xml/pedimento';
        $path = $path_xml.'/'. $company. '/';  
        $optr01 = PedimentoPrueba::where('pk_aduana', $bitacora->aduana)->where('pk_patente', $bitacora->patente)->where('pk_pedimento', $bitacora->pedimento)->first();
        $referen = $bitacora->aduana.'-'.$bitacora->patente.'-'.$bitacora->pedimento;
        //================================ CONSULTA PEDIMETO ========================================== 
        //$response = PedimentoPrueba::requestCompleteXML($bitacora->aduana, $bitacora->patente, $bitacora->pedimento, $path);  
        $file = $path . 'consultarpedimentocompleto_'. $referen. '.xml';
        $platilla = 'consultarpedimentocompleto.xml';
        $response = $path .'response_complete_'. $referen. '.xml';
        $xml = simplexml_load_file($path_xml .'/'. $platilla);	
        PedimentoPrueba::setUserToken($xml);
        PedimentoPrueba::setComplete($bitacora->aduana, $bitacora->patente, $bitacora->pedimento, $xml);
        $xml->saveXML($file);
        if(file_exists($file))
        {  
             $send_xml = "curl -o " . $response . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPedimentoCompletoService" . '"' . " -d @" . $file . " https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPedimentoCompletoService";
            exec($send_xml);          
        }
        if(file_exists($response))
            return $response;
        
        return 0;
    }

    public static function setComplete($aduana,$patente,$pedimento,$xml)
    {
        $namespaces = $xml->getNamespaces(true);
        foreach ($xml->xpath('//con:peticion') as $peticion)
        { 
            $peticion->children($namespaces['com'])->aduana = $aduana;
            $peticion->children($namespaces['com'])->patente = $patente;
            $peticion->children($namespaces['com'])->pedimento = $pedimento;
        }
    }

    public static function fillData($response,$aduana,$patente,$pedimento, $idPedimento, $company)
    {
        $xml = simplexml_load_file($response);
        $referen = $aduana .'-'. $patente.'-'.$pedimento;
        $namespaces = $xml->getNamespaces(true);
        $observaciones = 'Error de conexión';
        $status = 0;
        if(!empty($xml->children($namespaces['S'])))
        {
            foreach($xml->children($namespaces['S'])->Body as $body)
            {
                foreach($body->children($namespaces['ns2'])->consultarPedimentoCompletoRespuesta as $content)
                {
                    if($content->children($namespaces['ns3'])->tieneError == 'false')
                    {
                        $noOperacion = $content->numeroOperacion;
                        if(!isset($content->children($namespaces['ns2'])->pedimento->children($namespaces['ns2'])->previoConsolidado))
                        {
                            $dataH = PedimentoPrueba::getFields($content,$aduana,$patente,$pedimento);        
                            $exist_optr01 = PedimentoPrueba::where('pk_aduana', $aduana)->where('pk_patente', $patente)->where('pk_pedimento',$pedimento)->count();
                            if($exist_optr01 == 0)
                            {
                                PedimentoPrueba::insert($dataH);            
                                //Insertar contribuciones a nivel pedimento
                                $rates = $content->pedimento->tasas;       
                                foreach ($rates as $rate) 
                                {                                 
                                    $dataC = Contribution::getFields($rate,$referen);
                                    if(!is_null($dataC))
                                        Contribution::insert($dataC);                   
                                }
                                //Insertar identificadores a nivel pedimento
                                $identif = $content->pedimento->identificadores;  
                                foreach ($identif as $ide)
                                {
                                    foreach($ide->identificadores as $key)
                                    {
                                        $dataId = IdentifierPrueba::getFields($key,$referen, $company);
                                        if(!is_null($dataId))
                                            IdentifierPrueba::insert($dataId);
                                    }
                                }
                            }  
                            else
                            {
                                PedimentoPrueba::getDataExist($referen, $idPedimento, $company);
                            }                             
                            //Insertar facturas relacionadas al pedimento
                            $invoice = $content->pedimento->facturas;
                            $total_item = 0;
                            if(!isset($invoice) || is_null($invoice))
                            {                                            
                                 BitacoraCove::insert(['bitacora_pedimento_id' => $idPedimento, 'cove' => '', 'status' => 1, 'observaciones' => 'El pedimento no cuenta con COVE']);
                            }
                            else
                            {
                                foreach ($invoice as $inv) 
                                {
                                    $clave = $content->pedimento->encabezado->claveDocumento->clave; 
                                    $copera = $content->pedimento->encabezado->tipoOperacion->clave;
                                    $is_cove = substr($inv->numero, 0, 4); 
                                    $exist_optr02 = Invoice::where('pk_referencia', $referen)->where('pk_cove', $inv->numero)->orwhere('pk_factura', $inv->numero)->count();
                                    if($exist_optr02 == 0)
                                    {
                                        $dataI = Invoice::getFields($inv,$content,$referen);
                                        if(!is_null($dataI))
	                                        $receipt = Invoice::insert($dataI);	 
                                    }
                                    $exis_cove = BitacoraCove::where('bitacora_pedimento_id', $idPedimento)->where('cove', $inv->numero)->count();
                                    if($exis_cove == 0) 
                                    {                                    
                                        if($is_cove == 'COVE')
                                            BitacoraCove::insert(['bitacora_pedimento_id' => $idPedimento,'cove' => $inv->numero,'status' => 0]);
                                    }                                    
                                }
                            }
                            //================================================ Consulta de partidas =============================================
                            $partidas = '';
                            $items = $content->pedimento->partidas; 
                            //total de partidas a recuperar
                            $total_item = count($items);
                            BitacoraPedimento::where('id',$idPedimento)->update(['tpartidas' => $total_item,'operacion' => $noOperacion]);                            
                            // Validar que se han recuperado todas las partidas
                            $toptr03 = ItemPrueba::where('pk_referencia', $referen)->count();
                            if($toptr03 < $total_item)
                            {
                                foreach($items as $item)         
                                    PedimentoPrueba::consultaPartida($item, $idPedimento, $aduana, $patente, $pedimento, $noOperacion, $company);
                            }
                            // Actualizacion del total de contribuciones
                            $cash = Contribution::where('pk_referencia', $referen)->where('con_fpago', 0)->sum('con_importe');
                            if(is_null($cash))
                                $cash = 0;
                            $other = Contribution::where('pk_referencia', $referen)->where('con_fpago', '!=', 0)->sum('con_importe');
                            if(is_null($other))
                                $other = 0;
                            $total_cont = $cash + $other;
                            PedimentoPrueba::where('pk_referencia', $referen)->update(['ref_efectivo' => $cash, 'ref_otros' => $other, 'ref_total' => $total_cont]);
                            //======================================================================================

                            if($total_item == $toptr03)
                            {
                                $status = 2;    
                                $observaciones = 'Pedimento recuperado';
                            }
                            else
                            {
                                 $status = 1;
                                 $observaciones = 'Error al recuperar partida';
                            }
                            
                        }
                        else
                        {
                            $status = 0;
                            $observaciones = 'Previo Consolidado - Intentelo posteriormente';
                        }
                    }
                    else
                    {
                        $status = 0;
                        $observaciones = $content->children($namespaces['ns3'])->error->children($namespaces['ns3'])->mensaje;
                    }
                }  
            }
        }
        return ['observaciones' => $observaciones, 'status' => $status];
        
                        
    }

    public static function getFields($content,$aduana,$patente,$pedimento)
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
        
        $payment = $head->valorComercialTotal;
        $secure = $content->pedimento->importadorExportador->seguros;
        $charter = $content->pedimento->importadorExportador->fletes;
        $pack = $content->pedimento->importadorExportador->embalajes;
        $otherin = $content->pedimento->importadorExportador->incrementables;
        $datePay = NULL;
        $dateEnt = NULL;
        $referen = $aduana.'-'.$patente.'-'.$pedimento;

        $dateOut = $content->pedimento->importadorExportador->fechas;        
        foreach ($dateOut as $date) 
        {
            $type = $date->tipo->clave;
            if($type == 2)
                $datePay = $date->fecha;
            else
                $dateEnt = $date->fecha;
        }
        $caof02 = CPedimento::where('cpe_clave',$clave)->first();
        if($typeop == 1)
        {
            $regimen = $caof02->cpe_regi;
            $opera  = 'IMP';
            $valDolar = (double)$valAduana / (double)$tc;
        }
        else
        {
            $regimen = $caof02->cpe_rege;
            $opera = 'EXP';
            $valDolar = (double)$payment / (double)$tc;
        }
        if(isset($content->pedimento->rectificacion)) 
        {
            $rectificacion = $content->pedimento->rectificacion;
            $aduana_original = $rectificacion->aduanaOriginal->clave;
            $pedimento_original = $rectificacion->pedimentoOriginal;
            $referencia_original = $aduana_original ."-". $rectificacion->patenteOriginal ."-". $rectificacion->pedimentoOriginal;
            $clave_original = $rectificacion->claveDocumento->clave;
            $datePay = $rectificacion->fechaOriginal;
            $dateR1 = $rectificacion->fechaPago;
            $clave = 'R1';
            PedimentoPrueba::where('pk_referencia', $referencia_original)->update(['ref_referen' => $referen, 'ref_status' => 'R']);
        } 
        else
        {
            $referencia_original = '';
            $pedimento_original = '';
            $clave_original = '';
            $dateR1 = NULL;
            $aduana_original = '';
        }
        $cash = $content->pedimento->importadorExportador->efectivo;
        $other = $content->pedimento->importadorExportador->otros;
        $total = $cash + $other;
        $observation = $content->pedimento->observaciones;        
        $identifi = $content->pedimento->identificadores; 
        //============== Insertar Encabezado de Pedimento ===============
        
        $data = ['pk_referencia' => $referen,'pk_patente' => $patente,'pk_pedimento' => $pedimento,'pk_aduana' => $aduana,'ref_tipo' => $typeop,'ref_tipodoc' => 'P','ref_tipope'=> $opera,'ref_pedimento'=>$patente.'-'.$pedimento,'ref_clave' => $clave,'ref_regimen' => $regimen,'ref_destino' => $dest,'ref_tipocambio' => $tc,'ref_pesokg' => $weight,'ref_aduanaes' => $aduanaeo,'ref_transport1' => $tranEnt,'ref_transport2' => $tranArr,'ref_transport3' => $tranOut,'ref_valorusd' => $valDolar,'ref_valoradu' => $valAduana,'ref_preciopag' => $payment,'ref_seguros' => $secure,'ref_fletes' => $charter,'ref_embalajes' => $pack,'ref_otrosinc' => $otherin,'ref_fechapago' => $datePay,'ref_fechaentra' => $dateEnt,'ref_fechaext' =>NULL,'ref_fechapre' => NULL,'ref_fechact' => NULL,'ref_fechar1' => $dateR1,'ref_fechavence' => NULL, 'ref_referen' => $referencia_original,'ref_claveori' => $clave_original, 'ref_aduanaori' => $aduana_original,'ref_pedori' => $pedimento_original,'ref_efectivo' => $cash,'ref_otros' => $other,'ref_total' => $total,'ref_observa' => $observation,'origen' => 1];

        return $data;
    }

    public static function consultaPartida($item, $idPedimento, $aduana, $patente, $pedimento, $noOperacion, $company)
    {
        $referen = $aduana.'-'.$patente.'-'.$pedimento;       
        $search_optr03 = ItemPrueba::where('pk_referencia', $referen)->where('pk_sec', $item)->count();
        if($search_optr03 == 0)
        {
            $response = ItemPrueba::generarXML($item, $aduana, $patente, $pedimento, $noOperacion, $company);  
            if(file_exists($response))
                ItemPrueba::fillData($response, $aduana.'-'.$patente.'-'.$pedimento, $company);
        }
  
    }

    public static function getDataExist($referen, $idPedimento, $company)
    {
       // $company = session()->get('company');
        $bitacora = BitacoraPedimento::find($idPedimento);
        //Identificadores nivel pedimento
        $ed_seceped = IdentifierPrueba::where('pk_referencia',$referen)->where('clave_des','ED')->get();
        foreach ($ed_seceped as $edped) 
        {
            $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('reference',$referen)->where('edocument',$edped->descripcion)->count();
            if($num_ed == 0)
                \DB::connection('mysql')->table('bitacora_ED')->insert(['reference' => $referen,'edocument' => $edped->descripcion,'company_id' => $company,'period' => date("Y", strtotime($bitacora->fecha))]);
        }
        //Identificadores nivel partida
        $ed_secepar = IdentifierItemPrueba::where('pk_referencia',$referen)->where('clave_des','ED')->get();
        foreach ($ed_secepar as $edpar) 
        {
            $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('reference',$referen)->where('edocument',$edpar->descripcion)->count();
            if($num_ed == 0)
                \DB::connection('mysql')->table('bitacora_ED')->insert(['reference' => $referen,'edocument' => $edpar->descripcion,'company_id' => $company,'period' => date("Y", strtotime($bitacora->fecha))]);
        }

    }
}