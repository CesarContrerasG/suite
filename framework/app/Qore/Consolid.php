<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consolid extends Model
{
    use SoftDeletes;

    protected $table = "mdb_consolid";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["con_campo", "con_tipo", "con_valor"];
    protected $dates = ["deleted_at"];
}
