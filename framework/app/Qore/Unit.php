<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    
    protected $connection = 'mysql';
    protected $table = "mdb_umedida";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["ume_clave", "ume_nombre"];
    protected $dates = ["deleted_at"];
}
