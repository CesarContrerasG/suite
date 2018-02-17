<?php 

namespace App\Recove;

use Illuminate\Database\Eloquent\Model;
use App\User;

class RFCCOnsulta extends Model{

    protected $connection = 'default';
    protected $table = 'cove_rfcconsulta';
    protected $guarded = ['pk_item'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        $bd = User::changeConnection();          
        $this->connection = $bd;
    }
}