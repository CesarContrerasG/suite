<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Events\Qore\InvoiceWasRegistered;
use App\Events\Qore\PaymentWasRegistered;
use App\Events\Qore\ContractWasRegistered;

use App\Setup\Configuration;
use App\Qore\Product;
use App\Qore\Details;
use App\Qore\Invoice;
use App\Qore\Pay;

class Contract extends Model
{
    use SoftDeletes;

    protected $table = "contracts";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["master_id", "company_id"];
    protected $dates = ["deleted_at"];

    public function master()
    {
        return $this->belongsTo('App\Setup\Master');
    }

    public function company()
    {
        return $this->belongsTo('App\Qore\Company');
    }

    public function details()
    {
        return $this->hasMany('App\Qore\Details');
    }

    public function dates()
    {
        return $this->hasOne('App\Qore\Dates');
    }

    public function billings()
    {
        return $this->hasMany('App\Qore\Invoice');
    }

    public function files()
    {
        return $this->hasMany('App\Qore\Files');
    }

    public static function saveContract($request)
    {
        $details = $request->except(['master_id', 'company_id', 'credit_days']);
        $dates = $request->all();
        $contract = Contract::create($request->all());
        \DB::table('master_company')->where('master_id', $request->get('master_id'))->where('company_id', $request->get('company_id'))->update(['type' => 1]);
        $products = \Auth::user()->departament->company->master->products;
        foreach ($products as $product)
        {
            $val = $product->id;
            if(array_key_exists("product-".$val, $details) && array_key_exists("price-".$val, $details))
            {
                $detail = new Details;
                $detail->contract_id = $contract->id;
                $detail->service_id = $val;
                $detail->contract_price = $details['price-'.$val];
                $detail->active = 1;
                $detail->conditions = $details['conditions-'.$val];
                if($details['billing_date-'.$val] == "")
                {
                    $detail->billing_date = date("Y-m-d");
                }else {
                    $detail->billing_date = $details['billing_date-'.$val];
                }
                $detail->billing_cycle = $details['billing_cycle-'.$val];
                $detail->save();
            }
            else
            {
                $detail = new Details;
                $detail->contract_id = $contract->id;
                $detail->service_id = $val;
                $detail->contract_price = $product->price;
                $detail->active = 0;
                $detail->conditions = $details['conditions-'.$val];
                if($details['billing_date-'.$val] == "")
                {
                    $detail->billing_date = date("Y-m-d");
                }else {
                    $detail->billing_date = $details['billing_date-'.$val];
                }
                $detail->billing_cycle = $details['billing_cycle-'.$val];
                $detail->save();
            }
        }
        $dates['contract_id'] = $contract->id;
        Dates::create($dates);

        event(new ContractWasRegistered($contract));
    }

    public static function updateContract($contract, $request)
    {
         $dates = Dates::find($contract->dates->id);

        if(
            $dates->credit_days == $request->get('credit_days') &&
            $dates->revision_day == $request->get('revision_day') &&
            $dates->revision_time == $request->get('revision_time') &&
            $dates->payment_day == $request->get('payment_day') &&
            $dates->payment_time == $request->get('payment_time') &&
            $dates->opening_date == $request->get('opening_date') &&
            $dates->ending_date == $request->get('ending_date'))
        {
            // No realizamos cambios en el registro dates para el contrato
        }
        else
        {
            // Creamos el registro un nuevo regostro dates y mediante el uso de softdelete eliminamos el anterior
            $data = $request->all();
            $data['contract_id'] = $contract->id;
            $dates->delete();
            $dates->restore();
            $new = Dates::create($data);
        }

        foreach($contract->details as $detail)
        {
            $detalle = Details::find($detail->id);
            $service_id = $detalle->service_id;
            // echo 'Detalle con indice: '.$detalle->id.'. Del servicio con indice: '.$detalle->service_id.'<br>';
            if(
                $detalle->active == ($request->get('product-'.$service_id) == "on" ? 1 : 0) &&
                $detalle->contract_price == $request->get('price-'.$service_id) &&
                $detalle->conditions == $request->get('conditions-'.$service_id) &&
                $detalle->billing_date == $request->get('billing_date-'.$service_id) &&
                $detalle->billing_cycle == $request->get('billing_cycle-'.$service_id))
            {
                // echo 'Este detalle no cambio<br><br>';
            }
            else
            {
                // echo 'Este detalle cambio, usar softDelete y crear un registro nuevo<br><br>';
                $new_detail = new Details;
                $new_detail->contract_id = $detalle->contract_id;
                $new_detail->service_id = $detalle->service_id;
                $new_detail->contract_price = $request->get('price-'.$service_id);
                $new_detail->active = ($request->get('product-'.$service_id) == "on" ? 1 : 0);
                $new_detail->conditions = $request->get('conditions-'.$service_id);
                $new_detail->billing_date = $request->get('billing_date-'.$service_id);
                $new_detail->billing_cycle = $request->get('billing_cycle-'.$service_id);
                $new_detail->save();
                $detalle->delete();
                $detalle->restore();
            }
        }
    }

    public static function saveInvoice($contract, $request)
    {
        try {
            $services = explode(',', $request->get('services'));
            foreach ($services as $service) {
                $detail = Details::where('contract_id', $contract->id)->where('service_id', $service)->first();
                $newDetail = $detail->replicate();
                $detail->delete();
                $detail->restore();
                $newDetail->save();
                $newDetail->billing_date = Details::nextBillingDate($contract, $service);
                $newDetail->save();
            }
            $data = $request->all();

            $data['pendient'] = $request->get('payment_amount');
            if($request->hasFile('pdf') == true){
                $data['pdf'] = $request->file('pdf')->getClientOriginalName();
            }
            if($request->hasFile('xml') == true){
                $data['xml'] = $request->file('xml')->getClientOriginalName();
            }
            $invoice = Invoice::create($data);
            Invoice::storageImage($request, $invoice, \Auth::user()->current_master->rfc);

            event(new InvoiceWasRegistered($invoice));
            return true;
        } catch (Exception $e) {
            return "Excepcion capturada ".$e->getMessage();
        }
    }

    public static function savePayment($invoice, $request)
    {
        try {
            $payment_amount = $request->get('payment_amount');
            $invoice->pendient = ($invoice->pendient - $payment_amount);
            $invoice->payment = ($invoice->payment + $payment_amount);
            $invoice->save();

            $master = \Auth::user()->current_master->rfc;
            $data = $request->all();
            $data['voucher'] = $request->file('voucher')->getClientOriginalName();
            $pay = Pay::create($data);
            Pay::storageImage($request, $pay, $master);

            event(new PaymentWasRegistered($pay));

            return true;
        } catch (Exception $e) {
            return "Excepcion capturada ".$e->getMessage();
        }
    }

    public function needDatabase()
    {
        foreach ($this->details as $detail) {
            if ($detail->service->suite == 1) {
                return true;
            }
        }

        return false;
    }

    public function executeScripts()
    {
        $configuration = Configuration::where('master_id', $this->master_id)->first();
        foreach ($this->details as $detail) {
            if ($detail->service->suite == 1) {
                if($detail->service->module->database == 1){
                    $scripts = config('modules.scripts.'.$detail->service->module->script);
                    Configuration::createTables($this, $configuration, $scripts);
                }
            }
        }

        return true;
    }

    public static function history()
    {
        $results = Contract::select('created_at')->where('master_id', auth()->user()->current_master->id)->get();
        return $results;
    }

    public static function historyInvoice()
    {
        $results = array();

        $registers = Contract::where('master_id', auth()->user()->current_master->id)->get();
        $contracts = array();
        foreach ($registers as $register) {
            $contracts[] = $register->id;
        }
        $dates = Invoice::select('created_at')->whereIn('contract_id', $contracts)->get();

        $results['contracts'] = $contracts;
        $results['dates'] = $dates;

        return $results;
    }

    public static function historyPayment()
    {
        $results = array();

        $registers = Contract::where('master_id', \Auth::user()->current_master->id)->get();
        $contracts = array();
        foreach ($registers as $register) {
            $contracts[] = $register->id;
        }
        $invoices = Invoice::whereIn('contract_id', $contracts)->get();
        $billings = array();
        foreach ($invoices as $invoice) {
            $billings[] = $invoice->id;
        }
        $dates = Pay::select('created_at')->whereIn('invoice_id', $billings)->get();

        $results['dates'] = $dates;
        $results['billings'] = $billings;

        return $results;
    }

    public static function totalPayment()
    {
        $records = Contract::where('master_id', auth()->user()->current_master->id)->get();
        $contract_ids = array();
        $billings_pendients = array();
        foreach ($records as $record) {
            $contract_ids[] = $record->id;
            foreach ($record->billings->where('pendient', '>', 0) as $billing) {
                $billings_pendients[] = $billing;
            }
        }
        $billings = Invoice::whereIn('contract_id', $contract_ids)->get();

        $billings_ids = array();
        foreach ($billings as $billing) {
            $billings_ids[] = $billing->id;
        }

        $total_payment = Pay::whereIn('invoice_id', $billings_ids)->sum('payment_amount');
        return $total_payment;
    }

}
