<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\Qore\Valuation;
use App\ConnectionDB;

class Item extends Model{

    protected $connection = 'default';
    protected $table = 'optr03';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    public static function generarXML($item,$aduana,$patente,$pedimento,$opera)
    {
        $company = auth()->user()->company_name;
        $referen = $aduana.'-'.$patente.'-'.$pedimento;
        $path_xml = storage_path() . '/xml/pedimento';
        $path = $path_xml .'/'. $company.'/';
        $file = $path.'request_items_'.$referen.'.xml';
        $response_item =  $path."response_item_".$item."_".$referen.".xml";
       	$xml = simplexml_load_file($path_xml."/consultarpartida.xml");		
        $namespaces = $xml->getNamespaces(true);
        Pedimento::setUserToken($xml);

        foreach ($xml->xpath('//con:peticion') as $peticion)
        { 
            $peticion->children($namespaces['com'])->aduana = $aduana;
            $peticion->children($namespaces['com'])->patente = $patente;
            $peticion->children($namespaces['com'])->pedimento = $pedimento;
            $peticion->children($namespaces['com'])->numeroOperacion = $opera;
            $peticion->children($namespaces['com'])->numeroPartida = $item;
        }
		$xml->saveXML($file);
        if(file_exists($file))
        {
            $send_xml = "curl -o " . $response_item . " -k -H " . '"' ."Content-Type: text/xml; charset=utf-8" . '"' . " -H " . '"' ."SOAPAction:https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPartidaService" . '"' . " -d @" . $file . " https://www.ventanillaunica.gob.mx/ventanilla-ws-pedimentos/ConsultarPartidaService";
            exec($send_xml);                
        }
        return $response_item;
    }

    public static function fillData($response, $referen)
    {
        $xml = simplexml_load_file($response);
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
                                $dataG = Gravamen::getFields($grav,$dataIt['pk_sec'], $referen);
                                if(!is_null($dataG))
                                    Gravamen::insert($dataG);
                            }
                            $iditem = $itemChild->identificadores;
                            foreach ($iditem as $idxp) 
                            {
                                $dataIItem = IdentifierItem::getFields($idxp, $dataIt['pk_sec'], $referen);
                                if(!is_null($dataIItem))
                                    IdentifierItem::insert($dataIItem);
                            }
                        }
                    }
                }
            }
        }
    }

    public static function getFields($item, $referen)
    {
    	$number = $item->numeroPartida;
        $frac = $item->fraccionArancelaria;
        $descrip = $item->descripcionMercancia;
        $umt = $item->unidadMedidaTarifa->clave;
        $lotumt = $item->cantidadUnidadMedidaTarifa;
        $umc = $item->unidadMedidaComercial->clave;
        $lotumc = $item->cantidadUnidadMedidaComercial;
        $price = $item->precioUnitario;
        $valuepay = $item->valorComercial;
        $valueadu = $item->valorAduana;
        $valueusd = $item->valorDolares;
        $valueadd = $item->valorAgregado;
        $link = $item->vinculacion;
        $countod = $item->paisOrigenDestino->clave;
        $countcv = $item->paisVendedorComprador->clave;
        $observ = $item->observaciones;
        //$gravables = $item->gravamenes;   
        $metodo = 0;
        $metod = Valuation::where('val_descrip',$item->metodoValoracion)->first();
        if(!is_null($metod))
            $metodo = $metod->val_clave;
   		if($link == 'NO EXISTE VINCULACION')
            $idlink = '0';
        else
            $idlink = '1';
        $fracform = substr($frac,0,4).".".substr($frac,4,2).".".substr($frac, -2);
		$data  = ['pk_referencia' => $referen,'pk_sec' => $number,'sec_fraccion' => $fracform,'sec_desped' => $descrip,'sec_vinculacio' => $idlink,'sec_valoracion' => $metodo,'sec_umc' => $umc, 'sec_cantumc' => $lotumc,'sec_umt' => $umt,'sec_cantumt' => $lotumt,'sec_paiscv' => $countcv,'sec_paisod' => $countod,'sec_valoradu' => $valueadu,'sec_valorpag'=>$valuepay,'sec_preciouni' => $price,'sec_valoragre'=>$valueadd,'sec_valorusd' => $valueusd,'sec_observa' => $observ];

		return $data;

	}
}