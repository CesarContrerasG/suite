<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pay extends Model
{
    use SoftDeletes;

    protected $table = "contract_payments";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["invoice_id", "payment_date", "voucher", "payment_amount"];
    protected $dates = ["deleted_at"];

    public static function storageImage($request, $pay, $master)
    {
        if($request->hasFile('voucher'))
        {
            $year = date('Y', strtotime($request->get('payment_date')));
            $month = date('m', strtotime($request->get('payment_date')));
            $path = $master.'/'.$year.'/'.$month.'/payments\/'.$pay->id.'/';
            $request->file('voucher')->storeAs($path, $request->file('voucher')->getClientOriginalName(), 'qore');
        }

        return true;
    }

    public function invoice()
    {
        return $this->belongsTo('App\Qore\Invoice');
    }
}
