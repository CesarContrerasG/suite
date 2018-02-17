<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Contribution extends Model{

    protected $connection = 'default';
    protected $table = 'optr06';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';
    }

    public static function getFields($rate,$referen)
    {
    	$cont = $rate->contribucion->clave;                          
        $fpay = $rate->formaPago->clave;
        $import = $rate->importe;
        $name = $rate->contribucion->descripcion;
        $data = [
        	'pk_referencia' => $referen,
        	'pk_con' => $cont,
        	'con_concepto' => $name,
        	'con_fpago' => $fpay,
        	'con_importe' => $import
        ];
        
        return $data;
    }
}