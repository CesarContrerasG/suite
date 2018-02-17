<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_tipodocum";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["doc_clave", "doc_nombre"];
    protected $dates = ["deleted_at"];
}
