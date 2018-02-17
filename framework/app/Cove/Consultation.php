<?php
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Consultation extends Model
{
    protected $connection = 'default';
    protected $table = "caem15";
	protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;
    
    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    
    public static function insertOrUpdate($consultation, $request)
    {
        $consultation->rfc_consulta = $request->rfc_consulta;
        $consultation->nombre_consulta = $request->nombre_consulta;
        $consultation->save();
    }
}