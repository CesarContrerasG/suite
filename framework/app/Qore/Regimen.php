<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regimen extends Model
{
    use SoftDeletes;

    protected $table = "mdb_regimen";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["reg_clave", "reg_descrip"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->reg_descrip) >= 50)
        {
            return substr($this->reg_descrip, 0, 50)."...";
        }
        return $this->reg_descrip;
    }
}
