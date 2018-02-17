<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Material extends Model
{
    protected $connection = 'default';
    protected $table = "caem02";
	protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;
    
    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function getShortDescriptionAttribute()
    {
        return substr($this->mat_descove, 0, 15)."...";
    }

    public static function insertOrUpdate($material, $request)
    {
        $material->pk_mat = $request->pk_mat;
        $material->mat_codigoprov = $request->mat_codigoprov;
        $material->mat_des = $request->mat_des;
        $material->mat_descove = $request->mat_descove;
        $material->mat_pesounitario = $request->mat_pesounitario;
        $material->mat_fracci = $request->mat_fracci;
        $material->mat_umc = $request->mat_umc;
        $material->mat_oma = $request->mat_oma;
        $material->mat_tipo = $request->mat_tipo;
        $material->mat_fechai = $request->mat_fechai;
        $material->mat_fechaf = $request->mat_fechaf;
        $material->save();
    }
}