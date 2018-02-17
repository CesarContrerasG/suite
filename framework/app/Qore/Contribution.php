<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribution extends Model
{
    use SoftDeletes;

    protected $table = "mdb_contrib";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["con_clave", "con_descrip", "con_abrev", "con_nivel"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->con_descrip) >= 40)
        {
            return substr($this->con_descrip, 0, 40)."...";
        }
        return $this->con_descrip;
    }

}
