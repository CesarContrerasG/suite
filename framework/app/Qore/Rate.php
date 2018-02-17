<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;

    protected $table = "mdb_tasas";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["tas_clave", "tas_descrip"];
    protected $dates = ["deleted_at"];
}
