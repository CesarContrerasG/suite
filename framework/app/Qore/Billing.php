<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use SoftDeletes;

    protected $table = "mdb_tfactura";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["tfa_clave", "tfa_descrip"];
    protected $dates = ["deleted_at"];
}
