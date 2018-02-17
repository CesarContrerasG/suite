<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationA31 extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_destinos_a31";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["des_clave", "des_descrip"];
    protected $dates = ["deleted_at"];

    public function discharges()
    {
        return $this->hasMany('App\Anexo31\Discharge');
    }
}


    
