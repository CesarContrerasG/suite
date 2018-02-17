<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Gravamen extends Model{

    protected $connection = 'default';
    protected $table = 'optr07';
    protected $guarded = ['pk_item'];
    public $timestamps = false;
    protected $primaykey = 'pk_item';

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function getFields($grav,$sec,$referen)
    {
		$key = $grav->claveGravamen->clave;
		$name = $grav->claveGravamen->descripcion;
        $tt = $grav->tasas->clave->clave;
        $rate = $grav->tasas->tasaAplicable;
        $fp = $grav->importes->formaPago->clave;
        if($fp == '')
            $fp = 0;
        $import = $grav->importes->importe; 
        $exis_iva = Contribution::where('pk_referencia', $referen)->where('con_concepto', 'IVA')->first();
        if(is_null($exis_iva))
        { 
            $data_ped = [
            	'pk_referencia' => $referen,
            	'pk_con' => $key,
            	'con_concepto' => $name,
            	'con_fpago' => $fp,
            	'con_importe' => $import
            ];
            if(!is_null($data_ped))
                Contribution::insert($data_ped);
        }
        else
        {
            $contribution = Contribution::find($exis_iva->pk_item);
            $contribution->con_importe = $contribution->con_importe + $import;

        }
		$data = [
			'pk_referencia' => $referen,
			'con_sec' => $sec ,
			'pk_con' => $key,
			'con_concepto' => $name,
			'con_tasa' => $rate,
			'con_tipotasa' => $tt,
			'con_fpago' => $fp,
			'con_importe' => $import
		];

		return $data;

    }

}