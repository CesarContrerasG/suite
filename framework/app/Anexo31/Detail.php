<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Detail extends Model{

    protected $connection = 'default';
    protected $table = 'detalle_descargo';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }    

    public function discharge()
    {
        return $this->belongsTo('App\Anexo31\Discharge');
    }
}