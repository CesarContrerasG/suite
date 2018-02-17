<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Customer extends Model
{
    protected $connection = 'default';
    protected $table = "caem05";
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
        return substr($this->cli_razon, 0, 10)."...";
    }

    public function getShortStreetAttribute()
    {
        return substr($this->cli_calle, 0, 15)."...";
    }

    public static function insertOrUpdate($customer, $request)
    {
        $customer->pk_cli = $request->pk_cli;
        $customer->cli_razon = $request->cli_razon;
        $customer->cli_paterno = $request->cli_paterno;
        $customer->cli_materno = $request->cli_materno;
        if($request->cli_tipo == 1)
            $customer->cli_rfc = $request->cli_taxid;
        else
            $customer->cli_taxid = $request->cli_taxid;
        $customer->cli_tipo = $request->cli_tipo;
        $customer->cli_curp = $request->cli_curp;
        $customer->cli_calle = $request->cli_calle;
        $customer->cli_col = $request->cli_col;
        $customer->cli_noext = $request->cli_noext;
        $customer->cli_noint = $request->cli_noint;
        $customer->cli_cp = $request->cli_cp;
        $customer->cli_mpo = $request->cli_mpo;
        $customer->cli_edo = $request->cli_edo;
        $customer->cli_pais = $request->cli_pais;
        $customer->cli_localidad = $request->cli_localidad;
        $customer->save();
    }
}