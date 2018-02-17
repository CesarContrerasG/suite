<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Provider extends Model
{
    protected $connection = 'default';
    protected $table = "caem04";
	protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;
    
    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    
    public function getShortNameAttribute()
    {
        return substr($this->pro_razon, 0, 10)."...";
    }

    public function getShortStreetAttribute()
    {
        return substr($this->pro_calle, 0, 15)."...";
    }

    public static function insertOrUpdate($provider, $request)
    {
        $provider->pk_pro = $request->pk_pro;
        $provider->pro_razon = $request->pro_razon;
        $provider->pro_paterno = $request->pro_paterno;
        $provider->pro_materno = $request->pro_materno;
        if($request->pro_tipo == 1)
            $provider->pro_rfc = $request->pro_taxid;
        else
            $provider->pro_taxid = $request->pro_taxid;
        $provider->pro_tipo = $request->pro_tipo;
        $provider->pro_curp = $request->pro_curp;
        $provider->pro_calle = $request->pro_calle;
        $provider->pro_col = $request->pro_col;
        $provider->pro_noext = $request->pro_noext;
        $provider->pro_noint = $request->pro_noint;
        $provider->pro_cp = $request->pro_cp;
        $provider->pro_mpo = $request->pro_mpo;
        $provider->pro_edo = $request->pro_edo;
        $provider->pro_pais = $request->pro_pais;
        $provider->pro_localidad = $request->pro_localidad;
        $provider->save();
    }
}