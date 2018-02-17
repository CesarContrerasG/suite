<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Change extends Model
{
    use SoftDeletes;

    protected $table = "mdb_tipocambio";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["tpc_value", "tpc_fecha"];
    protected $dates = ["deleted_at"];
}
