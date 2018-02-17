<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $connection = 'mysql';
    protected $table = "types";
    protected $fillable = ["name"]; 

    public function modules()
    {
        return $this->belongsToMany('App\Sentry\Module', 'users_modules_types')->withPivot('user_id', 'status');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_modules_types')->withPivot('module_id', 'status');
    }

}
