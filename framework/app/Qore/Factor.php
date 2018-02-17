<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use SoftDeletes;

    protected $table = "mdb_fmonext";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["fmo_moneda", "fmo_equival", "fmo_fecha"];
    protected $dates = ["deleted_at"];
}
