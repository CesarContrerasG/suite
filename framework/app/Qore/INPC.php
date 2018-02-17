<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class INPC extends Model
{
    use SoftDeletes;

    protected $table = "mdb_inpc";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["inp_anio", "inp_periodo", "inp_valor", "inp_recargo"];
    protected $dates = ["deleted_at"];
}
