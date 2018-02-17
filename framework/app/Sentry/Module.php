<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "modules";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["name", "description", "version", "url", "color", "database", "script", "logo", "nivel"];
    protected $dates = ["deleted_at"];

    public function suite()
    {
        return $this->belongsTo('App\Sentry\Suite');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Qore\Company', 'modules_companies')->withPivot('active')->withTimestamps();
    }

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->description) > 80){
            return substr($this->description, 0, 80).'...';
        }
        return $this->description;
    }

    public static function storageImage($request)
    {
        if($request->hasFile('logo'))
        {
            $request->file('logo')->storeAs('/', $request->file('logo')->getClientOriginalName(), 'logos');
        }
        return true;
    }

    public function types()
    {
        return $this->belongsToMany('App\Sentry\Type', 'users_modules_types')->withPivot('user_id', 'status');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_modules_types')->withPivot('type', 'status');
    }

    public function getEstablishedTypesAttribute()
    {
        $types = \DB::table('modules_types')->where('module_id', $this->id)->where('active', 1)->select('type_id')->get();
        $array = array();
        foreach($types as $type)
        {
            $array[] = $type->type_id;
        }
        return \App\Sentry\Type::whereIn('id', $array)->get();
    }

    public static function addUserType($module, $type, $date)
    {
        $privilege = \DB::table('modules_types')->where('module_id', $module)->where('type_id', $type)->first();
        if(count($privilege) == 0){
            \DB::table('modules_types')->insert(['module_id' => $module, 'type_id' => $type, 'active' => 1, 'created_at' => $date, 'updated_at' => $date]);
        } else {
            $default = 0;
            if($privilege->active == 0){
                $default = 1;
            }
            \DB::table('modules_types')->where('id', $privilege->id)->update(["active" => $default, "updated_at" => $date]);
        }

        return true;
    }
}
