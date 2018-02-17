<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Detail extends Model{

    protected $connection = 'default';
    protected $table = 'cove_detalle';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
}