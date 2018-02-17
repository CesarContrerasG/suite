<?php 
namespace App\Recove;

use Illuminate\Database\Eloquent\Model;

class AgentED extends Model{

    protected $connection = 'default';
	protected $table = 'caem06';
	protected $fillable = ['pk_age','pk_emp','age_razon','age_rfc'];
    public $timestamps = false;

    public function __construct() {
        parent::__construct();
        
    }

    public function rules()
    {
        return [
        	'pk_age' => 'required',
        	'age_razon' => 'required',
        	'age_rfc'   => 'required'
        ];
    }
}
