<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Sentry\Module;

class Company extends Model
{
	use SoftDeletes;

	protected $connection = 'mysql';
	protected $guarded  =  ['id','created_at','updated_at'];
	protected $fillable = ['name', 'contact', 'logo', 'address', 'outdoor', 'interior', 'colony', 'location', 'town', 'state', 'pcode', 'country', 'phone', 'sector', 'status', 'rfc', 'curp', 'business_name', 'privileges', 'master_id'];
	protected $dates = ['deleted_at'];
	
	/*public static $permiso = 0;
	public static $master = 0;

	public function getHasAuthAttribute()
	{
		$module_id = session()->get('module');
		if(is_null($this->master))
		{
			self::$master = $this->masters()->wherePivot('type', 1)->first()->pivot->master_id;
			$module = $this->masters()->wherePivot('type', 1)->first()->suites()->where('module_id', $module_id)->where('active', 1)->first();
		}
		else
		{
			self::$master = $this->master_id;
			$module = $this->master->suites->where('master_id', $this->master_id)->where('module_id', $module_id)->where('active', 1)->first();
		}
		return $module;

		if(count($module) > 0)
		{
			if($module->active == 1)
			{
				self::$permiso = \Auth::user()->modules()->where('module_id', $module_id)->first()->pivot->type;
				return true;
			}
		}
		//return false;
	}*/

	/*public static function level()
	{
		return self::$permiso;
	}*/

	/*public static function namemaster()
	{
		return self::$master;
	}*/

	public function master()
	{
		return $this->belongsTo('App\Sentry\Master', 'master_id', 'id');
	}

	public function masters()
	{
		return $this->belongsToMany('App\Sentry\Master', 'master_company', 'company_id', 'master_id')->withPivot('type');
	}

	public function certifications()
	{
		return $this->belongsToMany('App\Qore\Certification', 'certification_company', 'company_id', 'certification_id')->withPivot('date_cert');
	}

	public function modules(){
		return $this->belongsToMany('App\Sentry\Module', 'modules_companies', 'company_id', 'module_id')->withPivot('active')->withTimestamps();
	}

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Qore\Departament');
    }

	public function departaments()
	{
		return $this->hasMany('App\Qore\Departament');
	}

	public function certificationsDates()
	{
		return $this->hasMany('App\Qore\Certification');
	}

	public static function toggleStatus($company)
	{
		if($company->status == 1)
    		$company->status = 0;
    	else
    		$company->status = 1;

    	$company->save();
	}

	

}
