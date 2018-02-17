<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use SoftDeletes;

    protected $table = "mdb_transp";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["tra_clave", "tra_medio"];
    protected $dates = ["deleted_at"];


    public function getShortMedioAttribute()
    {
        if(strlen($this->tra_medio) >= 50)
        {
            return substr($this->tra_medio, 0, 50)."...";
        }
        return $this->tra_medio;
    }
}
