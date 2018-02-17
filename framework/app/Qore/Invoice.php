<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = "contract_billings";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["contract_id", "billing_register", "pdf", "xml", "concepto", "payment_amount", "folio", "pendient"];
    protected $dates = ["deleted_at"];

    public static function storageImage($request, $invoice, $master)
    {
        if($request->hasFile('pdf'))
        {
            $year = date('Y', strtotime($request->get('billing_register')));
            $month = date('m', strtotime($request->get('billing_register')));
            $path = $master.'/'.$year.'/'.$month.'/billings\/'.$invoice->id.'/';
            $request->file('pdf')->storeAs($path, $request->file('pdf')->getClientOriginalName(), 'qore');
        }

        if($request->hasFile('xml'))
        {
            $year = date('Y', strtotime($request->get('billing_register')));
            $month = date('m', strtotime($request->get('billing_register')));
            $path = $master.'/'.$year.'/'.$month.'/billings\/'.$invoice->id.'/';
            $request->file('xml')->storeAs($path, $request->file('xml')->getClientOriginalName(), 'qore');
        }
        return true;
    }

    public function contract()
    {
        return $this->belongsTo('App\Qore\Contract');
    }

}
