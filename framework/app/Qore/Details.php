<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Details extends Model
{
    use SoftDeletes;

    protected $table = "contract_details";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["contract_id", "service_id", "contract_price", "active", "billing_date", "conditions", "billing_cycle"];
    protected $dates = ["deleted_at"];

    public function service()
    {
        return $this->belongsTo('App\Qore\Product', 'service_id');
    }

    public function cycle()
    {
        return $this->belongsTo('App\Qore\Cycles', 'billing_cycle');
    }

    public function contract()
    {
        return $this->belongsTo('App\Qore\Contract');
    }

    public static function nextBillingDate($contract, $service)
    {
        $detail = Details::where('contract_id', $contract->id)->where('service_id', $service)->first();
        $next = date("Y-m-d", strtotime($detail->billing_date." + ".$detail->cycle->period));
        return $next;
    }

}
