<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fraction extends Model
{
    use SoftDeletes;

    protected $table = "mdb_fraccion";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["fra_fraccion", "fra_descrip1", "fra_descrip2", "fra_descrip3", "fra_unidad", "fra_advotr"];
    protected $dates = ["deleted_at"];
}
