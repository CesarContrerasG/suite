<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OMACurrency extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_omamonedas";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["oma_clave", "oma_nombre", "oma_pais"];
    protected $dates = ["deleted_at"];
}
