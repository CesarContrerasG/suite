<?php 
namespace App\Anexo31;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Period extends Model{

    protected $connection = 'default';
    protected $table = 'periodos';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
        $this->guarded = ['id'];
    }   

    public function discharges()
    {
       return $this->hasMany('App\Anexo31\Discharge');
    } 


}