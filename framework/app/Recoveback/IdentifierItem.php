<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class IdentifierItem extends Model{

    protected $connection = 'default';
    protected $table = 'optr11';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';
    }
    
    public static function getFields($idxp,$sec,$referen,$emp)
    {
    	$key = $idxp->claveIdentificador->clave;
    	if($key == 'ED')
    		$descrip = $complemento1.' '.$complemento2.' '.$complemento3;
    	else
    		$descrip = $idxp->claveIdentificador->descripcion;

 		$complemento1 =  $idxp->complemento1;
        $complemento2 =  $idxp->complemento2;
        $complemento3 =  $idxp->complemento3;

        $pedimento = Pedimento::where('pk_referencia',$referen)->first();
        $periodo =  date('Y', strtotime($pedimento->ref_fechapago));


        if($key == 'ED')
        {   
            $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('referencia',$referen)->where('edocument',$descrip)->count();
            if($num_ed == 0)
                \DB::connection('mysql')->table('bitacora_ED')->insert(['referencia' => $referen,'edocument' => $descrip,'empresa' => $emp,'periodo' => $periodo]);
        }
		$data = [
			'sec' => $sec,
			'pk_referencia' => $referen,
			'clave_des' => $key,
			'descripcion' => $descrip
		];
		
		return $data;
    }

}