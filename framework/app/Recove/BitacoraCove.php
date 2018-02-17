<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class BitacoraCove extends Model{

    protected $connection = 'default';
    protected $table = 'bitacora_cove';
    protected $guarded = ['id','created_at'];

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
    
    public function bitacora_recove()
    {
        return $this->belongsTo('App\Recove\BitacoraPedimento');
    }
}