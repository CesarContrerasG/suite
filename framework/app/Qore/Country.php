<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_paises";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["pai_clavefiii", "pai_clavem3", "pai_nombre"];
    protected $dates = ['deleted_at'];

    public function getShortNombreAttribute()
    {
        if(strlen($this->pai_nombre) >= 40)
        {
            return substr($this->pai_nombre, 0, 40)."...";
        }
        return $this->pai_nombre;
    }
}
