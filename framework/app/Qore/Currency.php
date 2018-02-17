<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $table = "mdb_monedas";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["mon_clave", "mon_nombre", "mon_pais"];
    protected $dates = ["deleted_at"];

    public function country()
    {
        return $this->belongsTo('App\Qore\Country', 'mon_pais');
    }
}
