<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Invoice extends Model{

    protected $connection = 'default';
    protected $table = 'optr02';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';
    }

    public static function getFields($invoice,$content,$referen)
    {
    	$number = $invoice->numero;
        if(count($invoice->fecha) > 0)
            $date= $invoice->fecha;
        else
            $date = NULL;

        $incoterm = $invoice->terminoFacturacion->clave;
        $coin = $invoice->moneda->clave;
        $totalusd = $invoice->valorDolares;
        $valueme = $invoice->valorMonedaExtranjera;
        $provider = $invoice->identificadorFiscalProveedorComprador;
        $namepro = $invoice->proveedorComprador;
        if($totalusd != 0)
            $factor = $totalusd / $valueme;
        else
            $factor = 1; 
		$street = $content->pedimento->proveedoresCompradores->domicilio->calle;
        $munic = $content->pedimento->proveedoresCompradores->domicilio->ciudadMunicipio;                       
		$country = $content->pedimento->proveedoresCompradores->pais;
		$campos_fac = "pk_referencia,pk_factura,pk_cove,fac_clipro,fac_fecha,fac_incoterm,fac_moneda,fac_valorme,fac_factorme,fac_valorusd,fac_prorazon,fac_protaxid,fac_procalle,fac_prompo,fac_pais";

        
        $data = [
        	'pk_referencia' => $referen,
        	'pk_factura' => $number,
        	'pk_cove' => $number,
        	'fac_clipro' => $provider,
        	'fac_fecha' => $date,
        	'fac_incoterm' => $incoterm,
        	'fac_moneda' => $coin, 
        	'fac_valorme' => $valueme,
        	'fac_factorme' => $factor,
        	'fac_valorusd' => $totalusd,
            'fac_prorazon' => $namepro,
            'fac_protaxid' => $provider,
            'fac_procalle' => $street,
            'fac_prompo' => $munic,
            'fac_pais'=>$country
        ];

        return $data;
    }
   	
}