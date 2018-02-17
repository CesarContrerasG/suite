<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regularization extends Model
{
    use SoftDeletes;

    protected $table = "mdb_regular";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["reg_clave", "reg_descrip", "reg_instituc"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->reg_descrip) >= 25)
        {
            return substr($this->reg_descrip, 0, 25)."...";
        }
        return $this->reg_descrip;
    }

    public function getShortInstitutionAttribute()
    {
        if(strlen($this->reg_instituc) >= 30)
        {
            return substr($this->reg_instituc, 0, 30)."...";
        }
        return $this->reg_instituc;
    }
}
