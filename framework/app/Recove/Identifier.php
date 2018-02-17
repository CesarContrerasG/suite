<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;
use App\Qore\Company;

class Identifier extends Model{

    protected $connection = 'default';
    protected $table = 'optr10';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public static function getFields($ident, $referen)
    {
        //$company = auth()->user()->current_master->name;
        $company = auth()->user()->id;
        $id =  $ident->children()->claveIdentificador->clave;
        $complement = $ident->children()->complemento1;
        $pedimento = Pedimento::where('pk_referencia',$referen)->first();
        if(is_null($pedimento))
            $periodo = '';
        else
            $periodo =  date('Y', strtotime($pedimento->ref_fechapago));

        if($id == 'ED')
        {
            $num_ed = \DB::connection('mysql')->table('bitacora_ED')->where('reference',$referen)->where('edocument',$complement)->count();
            if($num_ed == 0)
                \DB::connection('mysql')->table('bitacora_ED')->insert(['reference' => $referen,'edocument' => $complement,'company_id' => $company,'period' => $periodo]);
        }
        $data = ['pk_referencia' => $referen,'clave_des' => $id, 'descripcion' => $complement];

        return $data;
    }
}