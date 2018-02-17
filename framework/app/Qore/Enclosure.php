<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enclosure extends Model
{
    use SoftDeletes;

    protected $table = "mdb_recintos";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["rec_clave", "rec_nombre", "rec_aduana"];
    protected $dates = ["deleted_at"];

    public function aduana()
    {
        return $this->belongsTo('App\Qore\Aduana', 'rec_aduana');
    }

}
