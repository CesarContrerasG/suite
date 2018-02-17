<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Patent extends Model
{
    protected $connection = 'default';
    protected $table = "caem06";
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
        return substr($this->age_razon, 0, 15)."...";
    }

    public static function insertOrUpdate($patent, $request)
    {
        $patent->pk_emp = $company;
        $patent->pk_age = $request->pk_age;
        $patent->age_razon = $request->age_razon;
        $patent->age_rfc = $request->age_rfc;
        $patent->age_curp = $request->age_curp;
        $patent->age_calle = $request->age_calle;
        $patent->age_col = $request->age_col;
        $patent->age_cp = $request->age_cp;
        $patent->age_mpo = $request->age_mpo;
        $patent->age_edo = $request->age_edo;
        $patent->age_pais = $request->age_pais;
        $patent->age_cont = $request->age_cont;
        $patent->age_mail = $request->age_mail;
        $patent->save();
    }
}