<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = "mdb_fpago";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["fpa_clave", "fpa_descrip"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->fpa_descrip) >= 50)
        {
            return substr($this->fpa_descrip, 0, 50)."...";
        }
        return $this->fpa_descrip;
    }

}
