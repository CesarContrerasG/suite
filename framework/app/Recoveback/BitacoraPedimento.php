<?php 
namespace App\Recove;
use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class BitacoraPedimento extends Model{
    protected $connection = 'default';
    protected $table = 'bitacora_recove';
    protected $guarded = ['id','created_at'];
    public $timestamps = true;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function bitacora_coves()
    {
        return $this->hasMany('App\Recove\BitacoraCove');
    }

}