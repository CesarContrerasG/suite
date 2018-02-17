<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Asset extends Model
{
    protected $connection = 'default';
    protected $table = "caem08";
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
        return substr($this->af_descove, 0, 15)."...";
    }

    public static function insertOrUpdate($asset, $request)
    {
        $asset->pk_af = $request->pk_af;
        $asset->af_codigoprov = $request->af_codigoprov;
        $asset->af_desc = $request->af_desc;
        $asset->af_descove = $request->af_descove;
        $asset->af_fracc = $request->af_fracc;
        $asset->af_umc = $request->af_umc;
        $asset->af_oma = $request->af_oma;
        $asset->af_tipo = $request->af_tipo;
        $asset->af_marca = $request->af_marca;
        $asset->af_modelo = $request->af_modelo;
        $asset->af_orden = $request->af_orden;
        $asset->af_serie = $request->af_serie;
        $asset->pk_emp = 'LAMTEC';
        $asset->save();
    }
}