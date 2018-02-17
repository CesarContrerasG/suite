<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departament extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo('App\Qore\Company');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public static function toggleStatus($departament)
    {
        if($departament->status == 1)
    		$departament->status = 0;
    	else
    		$departament->status = 1;

    	$departament->save();
    }
}
