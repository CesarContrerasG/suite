<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class Agent extends Model{

    protected $connection = 'default';
	protected $table = 'caem06';
	protected $fillable = ['pk_age','pk_emp','age_razon','age_rfc'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }
}
