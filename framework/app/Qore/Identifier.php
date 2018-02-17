<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Identifier extends Model
{
    use SoftDeletes;

    protected $table = "mdb_ident";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["ide_clave", "ide_descrip", "ide_nivel", "ide_comp"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->ide_descrip) >= 40)
        {
            return substr($this->ide_descrip, 0, 40)."...";
        }
        return $this->ide_descrip;
    }
}
