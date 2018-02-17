<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Ware extends Model{

    protected $connection = 'default';
    protected $table = 'cove_mercancia';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = User::changeConnection();          
        $this->connection = $bd;
    }
}