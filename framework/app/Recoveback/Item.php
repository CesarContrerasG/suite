<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\Qore\Valora;
use App\ConnectionDB;

class Item extends Model{

    protected $connection = 'default';
    protected $table = 'optr03';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';
    }
    public static function generarXML($seals,$item,$aduana,$patente,$pedimento,$opera)
    {
        $path = base_path().'/public/apps/recove/xml/';
       	$xml = simplexml_load_file($path."consultarpartida.xml");		
        $xml->registerXPathNamespace('wsse', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');
        $namespaces = $xml->getNamespaces(true);
        foreach ($xml->xpath('//wsse:UsernameToken') as $token)
        {
            $token->children($namespaces['wsse'])->Username = $seals->sello_rfc;
            $token->children($namespaces['wsse'])->Password = $seals->sello_wsp;
        }
        foreach ($xml->xpath('//con:peticion') as $peticion)
        { 
            $peticion->children($namespaces['com'])->aduana = $aduana;
            $peticion->children($namespaces['com'])->patente = $patente;
            $peticion->children($namespaces['com'])->pedimento = $pedimento;
            $peticion->children($namespaces['com'])->numeroOperacion = $opera;
            $peticion->children($namespaces['com'])->numeroPartida = $item;
        }

		$xml->saveXML($path.'consultarpartida_'.$seals->sello_rfc.'.xml');
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
        $metod = Valora::where('val_descrip',$item->metodoValoracion)->first();
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