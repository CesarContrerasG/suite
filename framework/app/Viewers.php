<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viewers extends Model
{
    use SoftDeletes;

    protected $table = "notifications_views";
    protected $fillable = ["notification_id", "user_id"];
    protected $dates = ["deleted_at"];
}
