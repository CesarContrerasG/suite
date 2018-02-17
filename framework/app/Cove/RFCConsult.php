<?php 

namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class RFCConsult extends Model{

    protected $connection = 'default';
    protected $table = 'cove_rfcconsulta';
    protected $guarded  =  ['pk_item'];
    protected $primaryKey='pk_item';
    public $timestamps = false;


    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function cove()
    {
        return $this->belongsTo('App\Cove\Cove', 'cove_factura');
    }
}