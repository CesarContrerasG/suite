<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = "certifications";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["name"];
    protected $dates = ["deleted_at"];

    public function companies()
    {
        return $this->belongsToMany('App\Qore\Company', 'certification_company', 'certification_id', 'company_id')->withPivot('date_cert')->withTimestamps();
    }
}
