<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Sentry\Master;
use App\Qore\Company;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $guarded =  ['id','created_at','updated_at'];
    protected $fillable = ['name', 'last_name', 'email', 'password', 'photo', 'departament_id', 'master_id', 'company_id', 'status'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->last_name;
    }

    public function setPasswordAttribute($value)
    {
        if(!empty($value))
        {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    public function getCurrentCompanyAttribute()
    {
        return $this->departament->company->master->id;
    }

    public function getCurrentDatabaseAttribute()
    {
        return $this->departament->company->master->db;
    }

    public function getCurrentMasterAttribute()
    {
        /*if($this->departament_id == 0)
        {
            return Master::find($this->master_id);
        }

        if(is_null($this->departament->company->master_id))
        {
            return $this->departament->company->masters()->wherePivot('type', 1)->first();
        }*/
        return $this->master;
    }

    public function getLevelAttribute()
    {
        return  $this->departament->company->level();
    }

    public static function storageImage($request, $user)
    {
        if($request->hasFile('photo'))
    	{
            $path = $user->id.'/';
            $request->file('photo')->storeAs($path, $request->file('photo')->getClientOriginalName(), 'users');
    	}
    	return true;
    }

    public static function toggleStatus($user)
    {
		if($user->status == 1)
    		$user->status = 0;
    	else
    		$user->status = 1;

    	$user->save();
    }

    public function master()
    {
        return $this->belongsTo('App\Sentry\Master');
    }
    
    public function company()
    {
        return $this->belongsTo('App\Qore\Company');
    }

    public function departament()
    {
        return $this->belongsTo('App\Qore\Departament');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Sentry\Module', 'users_companies_modules_types')->withPivot('type_id', 'active');
    }

    public function types()
    {
        return $this->belongsToMany('App\Sentry\Type', 'users_modules_types')->withPivot('module_id', 'status');
    }

    public function applications()
    {
        return $this->belongsToMany('App\Sentry\Module', 'users_companies_modules_types', 'user_id', 'module_id')->withPivot('company_id', 'type_id', 'active', 'id')->withTimestamps();
    }

    public function privileges()
    {
        return $this->belongsToMany('App\Sentry\Type', 'users_companies_modules_types', 'user_id', 'type_id')->withPivot('module_id', 'company_id', 'active', 'id')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany('App\Qore\Company', 'users_companies_modules_types', 'user_id', 'company_id')->withPivot('module_id', 'type_id', 'active', 'id')->withTimestamps();
    }

    public function getModulesActivesAttribute()
    {        

        return $this->modules()->wherePivot('status', 1)->get();
    }
    
    public static function getUsersOfAccount($master)
    {
        $num_records = User::where('master_id', $master->id)->count();
        return $num_records;
    }

    public static function clientsPluck()
    {
        $companies = auth()->user()->current_master->clients;
        $clients = array();
        foreach($companies as $company){
            $clients[$company->id] = $company->name;
        }

        return $clients;
    }

    public function getHaveAnyAdminAttribute()
    {
        if(count($this->applications) > 0)
        {
            $modules_where_is_admin = count($this->applications()->where('type_id', 3)->get());
            if($modules_where_is_admin > 0)
            {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getIsMasterUserAttribute()
    {
        if(count($this->modules) > 0)
        {
            $modules_where_is_admin = count($this->modules()->where('type_id', 2)->get());
            if($modules_where_is_admin > 0)
            {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getBelongsMasterAttribute()
    {
        if($this->company_id == $this->master->company_id){
            return true;
        }
        return false;
    }

    public function getCompanyNameAttribute()
    {
        $id_company = session()->get('company');
        $company = Company::find($id_company);

        return $company->name;
    }

    public function getPermissionCoveAttribute()
    {  
        $id_company = session()->get('company');  
        $type = $this->companies($id_company)->wherePivot('module_id', 4)->first()->pivot->type_id;

        return $type;
    }
    
    public function getPermissionRecoveAttribute()
    {  
        $id_company = session()->get('company');  
        $type = $this->companies($id_company)->wherePivot('module_id', 3)->first()->pivot->type_id;

        return $type;
    }
        

}
