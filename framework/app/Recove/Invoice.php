<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Invoice extends Model{

    protected $connection = 'default';
    protected $table = 'optr02';
    protected $guarded = ['pk_item'];
    public $timestamps = false;
    protected $primaryKey= 'pk_item';

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
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
        if($valueme > 0)
        {
            $factor_float = (double) $totalusd / (double)$valueme;
            if($totalusd != 0)
                $factor = round($factor_float,8);
            else
                $factor = 1; 
        }
        else
        {
            $factor = 1;
        }
		$street = $content->pedimento->proveedoresCompradores->domicilio->calle;
        $exteriorNumber = $content->pedimento->proveedoresCompradores->domicilio->numeroExterior;
        $interiorNumber = $content->pedimento->proveedoresCompradores->domicilio->numeroInterior;
        $munic = $content->pedimento->proveedoresCompradores->domicilio->ciudadMunicipio;        
        $postalCode = $content->pedimento->proveedoresCompradores->domicilio->codigoPostal;        
		$country = $content->pedimento->proveedoresCompradores->pais;
		//$campos_fac = "pk_referencia,pk_factura,pk_cove,fac_clipro,fac_fecha,fac_incoterm,fac_moneda,fac_valorme,fac_factorme,fac_valorusd,fac_prorazon,fac_protaxid,fac_procalle,fac_prompo,fac_pais";

        
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
            'fac_noext' => $exteriorNumber,
            'fac_noint' => $interiorNumber,
            'fac_prompo' => $munic,
            'fac_procp'  => $postalCode,
            'fac_pais'=>$country
        ];

        return $data;
    }
   	
}