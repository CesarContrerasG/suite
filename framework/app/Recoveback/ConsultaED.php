<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;


class ConsultaED extends Model{
    protected $connection = 'default';
    protected $table = 'opauimg';
    protected $guarded = ['iImageID'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::connectionPedimento();          
        $this->connection = 'pedimentos';
    }

    public function getRouteKeyName()
    {
        return 'iImageID';
    }
}