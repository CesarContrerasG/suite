<?php 
namespace App\Cove;

use Illuminate\Database\Eloquent\Model;
use App\ConnectionDB;

class AcuseCove extends Model{
    protected $connection = 'default';
    protected $table = 'opauimg';
    protected $guarded = ['iImageID'];
    protected $primaryKey  = 'iImageID';
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = ConnectionDB::changeConnection();          
        $this->connection = $bd;
    }

    public function getRouteKeyName()
    {
        return 'iImageID';
    }
}