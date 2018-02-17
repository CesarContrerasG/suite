<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;

class SealED extends Model{    
    protected $connection = 'default';    
	protected $table = 'caem16';
	protected $fillable = ['pk_emp','sello_rfc','sello_key','sello_cer','sello_vigencia','sello_password','sello_wsp','sello_key64','sello_cer64','sello_vigencia'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
    }
    
    public function getRouteKeyName()
    {
        return 'pk_item';
    }

}
