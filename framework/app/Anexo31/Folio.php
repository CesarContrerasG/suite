<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Folio extends Model{

    protected $connection = 'default';
    protected $table = 'folio_asociados';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }    

    public function discharge()
    {
       return $this->belongsTo('App\Anexo31\Discharge','descargo_id');
    }
}