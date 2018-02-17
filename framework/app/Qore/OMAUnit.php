<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OMAUnit extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_omaumedida";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["oma_clave", "oma_nombre"];
    protected $dates = ["deleted_at"];
}
