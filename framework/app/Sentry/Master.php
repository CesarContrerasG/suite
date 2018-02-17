<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Qore\Contract;
use App\Qore\Details;
use App\Qore\Product;
use App\Qore\Invoice;
use App\Qore\Pay;

class Master extends Model
{
    use softDeletes;


    protected $connection = 'mysql';
    protected $table = "masters";

    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["name", "db", "rfc"];
    protected $dates = ["deleted_at"];

    public function company()
    {
        return $this->hasOne('App\Qore\Company');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Qore\Company', 'master_company', 'master_id', 'company_id')->withPivot('type')->withTimestamps();
    }

    public function clients()
    {
        return $this->belongsToMany('App\Qore\Company', 'master_company', 'master_id', 'company_id')->wherePivot('type', 1)->wherePivot('deleted', NULL);
    }

    public function providers()
    {
        return $this->belongsToMany('App\Qore\Company', 'master_company', 'master_id', 'company_id')->wherePivot('type', 2)->wherePivot('deleted', NULL);
    }

    public function prospects()
    {
        return $this->belongsToMany('App\Qore\Company', 'master_company', 'master_id', 'company_id')->wherePivot('type', 3)->wherePivot('deleted', NULL);
    }

    public function contrators()
    {
        return $this->belongsToMany('App\Qore\Company', 'master_company', 'master_id', 'company_id')->wherePivotIn('type', [1,3])->wherePivot('deleted', NULL);
    }

    public function suites()
    {
        return $this->hasMany('App\Sentry\Suite');
    }

    public function products()
    {
        return $this->hasMany('App\Qore\Product');
    }

    public function contracts()
    {
        return $this->hasMany('App\Qore\Contract');
    }

    public function getSuiteApplicationsAttribute()
    {
        $actives =  $this->suites;
        $ids = array();
        foreach($actives as $active){
            $ids[] = $active->module_id;
        }
        $modules = Module::whereIn('id', $ids)->whereIn('nivel', [1,2])->get();
        return $modules;
        
    }

    public function getAnnualInvoicesAttribute()
    {
        $contracts = $this->contracts;
        $annual_invoices = 0;

        foreach ($contracts as $contract) {
            foreach ($contract->billings as $billing) {
                if (date('Y', strtotime($billing->billing_register)) == date('Y')) {
                    $annual_invoices += $billing->payment_amount;
                }
            }
        }

        return $annual_invoices;
    }

    public function getMonthlyInvoicesAttribute()
    {
        $contracts = $this->contracts;
        $monthly_invoices = 0;

        foreach ($contracts as $contract) {
            foreach ($contract->billings as $billing) {
                if (date('Y', strtotime($billing->billing_register)) == date('Y')) {
                    $monthly_invoices += $billing->payment_amount;
                }
            }
        }

        return $monthly_invoices;
    }

    public function getPayServicesAttribute()
    {
        $collection = $this->contracts->each(function($item, $key){
            if(date('Y', strtotime($item->dates->opening_date)) == date('Y')){
                $item;
            }
        });

        $array_collection = array();
        $point = 0;
        foreach($collection as $contract_service){
            $contract = Contract::find($contract_service->id);
            $array_collection[$point]["contract"] = $contract->id;
            $array_collection[$point]["num_products"] = $contract->details->where('active', 1)->count();

            $num_products = $contract->details->where('active', 1)->count();
            $base = $contract->details->where('active', 1)->sum('contract_price');

            $total_billings = 0;
            foreach ($contract->billings as $billing) {
                $total_billings += $billing->payment_amount;
            }

            $service_collection = array();
            $i = 0;
            foreach($contract->details as $detail) {
                if($detail->service->suite == 0){
                    $service_collection[$i]['service'] = $detail->service_id;
                    $price = $detail->contract_price;
                    $service_collection[$i]['price'] = $price;
                    $factor = ($price / $base);
                    $service_collection[$i]['factor'] = $factor;
                    $service_collection[$i]['payment'] = ($total_billings * $factor);
                }
                $i++;
            }

            $array_collection[$point]["total_payment"] = $total_billings;
            $array_collection[$point]["average_for_service"] = ($total_billings / $num_products);
            $array_collection[$point]["detail"] = $service_collection;
            $point++;
        }
        $collection_services = collect($array_collection);

        $grouped = array();
        $services = array();

        foreach ($collection_services as $collections) {
            foreach($collections['detail'] as $collection) {
                $grouped[$collections['contract']][$collection['service']] = $collection['payment'];
                $services[] = $collection['service'];
            }
        }

        $grouped = collect($grouped);

        $data_chart_services = array();
        $data_chart['total'] =  $collection_services->sum('total_payment');
        $i = 0;
        foreach (array_unique($services) as $id) {
            $product = Product::findOrFail($id);
            $data_chart_services[$i]['quantity'] = $grouped->sum($id);
            $data_chart_services[$i]['name'] = $product->name;
            $i++;
        }
        $data_chart['services'] = $data_chart_services;

        return $data_chart;
    }

    public function getPayServicesMonthlyAttribute()
    {
        $collection = $this->contracts->each(function($item, $key){
            if(date('Y', strtotime($item->dates->opening_date)) == date('Y')){
                if(date('m', strtotime($item->dates->opening_date)) == date('m')){
                    $item;
                }
            }
        });

        $array_collection = array();
        $point = 0;
        foreach($collection as $contract_service){
            $contract = Contract::find($contract_service->id);
            $array_collection[$point]["contract"] = $contract->id;
            $array_collection[$point]["num_products"] = $contract->details->where('active', 1)->count();

            $num_products = $contract->details->where('active', 1)->count();
            $base = $contract->details->where('active', 1)->sum('contract_price');

            $total_billings = 0;
            foreach ($contract->billings as $billing) {
                $total_billings += $billing->payment_amount;
            }

            $service_collection = array();
            $i = 0;
            foreach($contract->details as $detail) {
                if($detail->service->suite == 0){
                    $service_collection[$i]['service'] = $detail->service_id;
                    $price = $detail->contract_price;
                    $service_collection[$i]['price'] = $price;
                    $factor = ($price / $base);
                    $service_collection[$i]['factor'] = $factor;
                    $service_collection[$i]['payment'] = ($total_billings * $factor);
                }
                $i++;
            }

            $array_collection[$point]["total_payment"] = $total_billings;
            $array_collection[$point]["average_for_service"] = ($total_billings / $num_products);
            $array_collection[$point]["detail"] = $service_collection;
            $point++;
        }
        $collection_services = collect($array_collection);

        $total_services = 0;
        foreach ($collection_services as $collections) {
            foreach($collections['detail'] as $collection) {
                $total_services += $collection['payment'];

            }
        }

        $data_chart = array();
        $data_chart['total_services'] = $total_services;
        $data_chart['total_billings'] = $collection_services->sum('total_payment');

        return $data_chart;

    }

    public function getPaySystemsAttribute()
    {
        $collection = $this->contracts->each(function($item, $key){
            if(date('Y', strtotime($item->dates->opening_date)) == date('Y')){
                $item;
            }
        });

        $array_collection = array();
        $point = 0;
        foreach($collection as $contract_service){
            $contract =  Contract::find($contract_service->id);
            $array_collection[$point]["contract"] = $contract->id;
            $array_collection[$point]["num_products"] = $contract->details->where('active', 1)->count();

            $num_products = $contract->details->where('active', 1)->count();
            $base = $contract->details->where('active', 1)->sum('contract_price');

            $total_billings = 0;
            foreach($contract->billings as $billing){
                $total_billings += $billing->payment_amount;
            }

            $service_collection = array();
            $i = 0;
            foreach($contract->details as $detail){
                if($detail->service->suite == 1){
                    $service_collection[$i]['service'] = $detail->service_id;
                    $price = $detail->contract_price;
                    $service_collection[$i]['price'] = $price;
                    $factor = ($price / $base);
                    $service_collection[$i]['factor'] = $factor;
                    $service_collection[$i]['payment'] = ($total_billings * $factor);
                }
                $i++;
            }

            $array_collection[$point]["total_payment"] = $total_billings;
            $array_collection[$point]["average_for_service"] = ($total_billings / $num_products);
            $array_collection[$point]["detail"] = $service_collection;
            $point++;
        }

        $collection_systems = collect($array_collection);

        $grouped = array();
        $services = array();

        foreach ($collection_systems as $collections) {
            foreach($collections['detail'] as $collection) {
                $grouped[$collections['contract']][$collection['service']] = $collection['payment'];
                $services[] = $collection['service'];
            }
        }

        $grouped = collect($grouped);

        $data_chart = array();
        $data_chart_services = array();
        $data_chart['total'] =  $collection_systems->sum('total_payment');
        $i = 0;
        foreach (array_unique($services) as $id) {
            $product = Product::findOrFail($id);
            $data_chart_services[$i]['quantity'] = $grouped->sum($id);
            $data_chart_services[$i]['name'] = $product->name;
            $i++;
        }
        $data_chart['services'] = $data_chart_services;

        return $data_chart;
    }

    public function getPaySystemsMonthlyAttribute()
    {
        $collection = $this->contracts->each(function($item, $key){
            if(date('Y', strtotime($item->dates->opening_date)) == date('Y')){
                if(date('m', strtotime($item->dates->opening_date)) == date('m')){
                    $item;
                }
            }
        });

        $array_collection = array();
        $point = 0;
        foreach($collection as $contract_service){
            $contract = Contract::find($contract_service->id);
            $array_collection[$point]["contract"] = $contract->id;
            $array_collection[$point]["num_products"] = $contract->details->where('active', 1)->count();

            $num_products = $contract->details->where('active', 1)->count();
            $base = $contract->details->where('active', 1)->sum('contract_price');

            $total_billings = 0;
            foreach ($contract->billings as $billing) {
                $total_billings += $billing->payment_amount;
            }

            $service_collection = array();
            $i = 0;
            foreach($contract->details as $detail) {
                if($detail->service->suite == 1){
                    $service_collection[$i]['service'] = $detail->service_id;
                    $price = $detail->contract_price;
                    $service_collection[$i]['price'] = $price;
                    $factor = ($price / $base);
                    $service_collection[$i]['factor'] = $factor;
                    $service_collection[$i]['payment'] = ($total_billings * $factor);
                }
                $i++;
            }

            $array_collection[$point]["total_payment"] = $total_billings;
            $array_collection[$point]["average_for_service"] = ($total_billings / $num_products);
            $array_collection[$point]["detail"] = $service_collection;
            $point++;
        }
        $collection_systems = collect($array_collection);

        $total_systems = 0;
        foreach ($collection_systems as $collections) {
            foreach($collections['detail'] as $collection) {
                $total_systems += $collection['payment'];

            }
        }

        $data_chart = array();
        $data_chart['total_services'] = $total_systems;
        $data_chart['total_billings'] = $collection_systems->sum('total_payment');

        return $data_chart;
    }

    public static function companiesChart()
    {
        $records = [];
        for ($i=1; $i <= 12 ; $i++) {
            $records['clients'][$i] = \DB::table('master_company')->where('master_id', auth()->user()->current_master->id)->where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"),($i))->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("Y"))->where('type', 1)->count();
            $records['providers'][$i] = \DB::table('master_company')->where('master_id', auth()->user()->current_master->id)->where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"),($i))->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("Y"))->where('type', 2)->count();
            $records['prospects'][$i] = \DB::table('master_company')->where('master_id', auth()->user()->current_master->id)->where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"),($i))->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("Y"))->where('type', 3)->count();
        }

        return $records;
    }

    public static function panelAccount()
    {
        $results = array();

        $contracts = array();
        for ($i=1; $i <= 12; $i++) {
            $contracts[$i] = \DB::table('contracts')->where('master_id', \Auth::user()->master_id)->where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"),($i))->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), date("Y"))->count();
        }

        $records = Contract::where('master_id', auth()->user()->master_id)->get();
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

        $contract_actives = auth()->user()->master->contracts;

        $date_close = date_create(date('Y-m-d'));
        date_add($date_close, date_interval_create_from_date_string('15 days'));
        $limit = date_format($date_close, 'Y-m-d');

        $actives = array();
        $to_start = array();
        $to_close = array();
        foreach ($contract_actives as $contract) {
            if ($contract->dates->opening_date != "" &&
                $contract->dates->opening_date < date('Y-m-d') &&
                $contract->dates->ending_date != "" &&
                $contract->dates->ending_date > date('Y-m-d')) {
                $actives[] = $contract;
            }

            if($contract->dates->opening_date != "" && $contract->dates->opening_date > date('Y-m-d')){
                $to_start[] = $contract->dates;
            }

            if($contract->dates->ending_date != "" && $contract->dates->ending_date <= $limit){
                $to_close[] = $contract->dates;
            }
        }

        $results['contracts'] = $contracts;
        $results['actives'] = $actives;
        $results['to_start'] = $to_start;
        $results['to_close'] = $to_close;
        $results['billings'] = $billings;
        $results['total_payment'] = $total_payment;
        $results['billings_pendients'] = $billings_pendients;

        return $results;
    }
}
