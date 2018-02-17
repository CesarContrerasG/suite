<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valuation extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_valora";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["val_clave", "val_descrip"];
    protected $dates = ["deleted_at"];
}
