<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPedimento extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_cpedimen";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["cpe_clave", "cpe_descrip", "cpe_usos", "cpe_regi", "cpe_rege", "cpe_import", "cpe_export", "cpe_peps", "cpe_px", "cpe_dirigido", "cpe_ps"];
    protected $dates = ["deleted_at"];

    public function getShortDescriptionAttribute()
    {
        return substr($this->cpe_descrip, 0, 50)."...";
    }
}
