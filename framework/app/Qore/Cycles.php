<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycles extends Model
{
    use SoftDeletes;

    protected $table = "cycles";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["concept", "period"];
    protected $dates = ["deleted_at"];
}
