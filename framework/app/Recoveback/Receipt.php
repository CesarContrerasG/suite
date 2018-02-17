<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Receipt extends Model{

    protected $connection = 'default';
    protected $table = 'cove_comprobante';
    protected $guarded = ['inv_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
}