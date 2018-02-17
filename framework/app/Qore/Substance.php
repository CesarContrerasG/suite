<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Substance extends Model
{
    use SoftDeletes;

    protected $table = "mdb_sustanci";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["sus_clase", "sus_denomina"];
    protected $dates = ["deleted_at"];
}
