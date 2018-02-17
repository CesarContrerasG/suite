<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use SoftDeletes;

    protected $table = "mdb_destinos";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["des_clave", "des_descrip"];
    protected $dates = ["deleted_at"];
}
