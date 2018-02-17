<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends Model
{
    use SoftDeletes;

    protected $table = "mdb_conten";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["con_clave", "con_descrip"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->con_descrip) >= 50)
        {
            return substr($this->con_descrip, 0, 50)."...";
        }
        return $this->con_descrip;
    }

}
