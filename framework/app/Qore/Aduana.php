<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aduana extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "mdb_aduanas";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["adu_numero", "adu_seccion", "adu_denomina"];
    protected $dates = ["deleted_at"];

    public function getShortDenominationAttribute()
    {
        return substr($this->adu_denomina, 0, 40)."...";
    }

    public function getExtrashortDenominationAttribute()
    {
        return substr($this->adu_denomina, 0, 30)."...";
    }
}
