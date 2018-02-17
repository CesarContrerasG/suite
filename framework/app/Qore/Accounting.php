<?php

namespace App\Qore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Accounting extends Model
{
    use SoftDeletes;

    protected $table = "accounting_records";
    protected $fillable = ["date_payment", "type", "invoice_number", "check_number", "tax_sheet", "client", "description", "date_emition", "amount", "iva", "way_to_pay"];
    protected $dates = ["deleted_at"];

    public function getShortTaxAttribute()
    {
        if(strlen($this->tax_sheet) > 15) {
            return substr($this->tax_sheet, 0, 15)."...";
        }
        return $this->tax_sheet;
    }

    public function getShortDescriptionAttribute()
    {
        if(strlen($this->description) > 18) {
            return substr($this->description, 0, 18)."...";
        }
        return $this->description;
    }

    public static function incomeIVA($records)
    {
        $total = 0;
        foreach($records as $record) {
            if($record->type == 1) {
                $total += $record->iva;
            }
        }
        return $total;
    } 

    public static function expendituresIVA($records)
    {
        $total = 0;
        foreach($records as $record) {
            if($record->type == 0) {
                $total += $record->iva;
            }
        }
        return $total;
    }

    public static function subtotalIncome($records)
    {
        $total = 0;
        foreach($records as $record) {
            if($record->type == 1) {
                $total += ($record->amount + $record->iva);
            }
        }
        return $total;
    }

    public static function subtotalExpenditures($records)
    {
        $total = 0;
        foreach($records as $record) {
            if($record->type == 0) {
                $total += ($record->amount + $record->iva);
            }
        }
        return $total;
    }

    public static function previousBalance()
    {
        $date = Carbon::now();
        $month = $date->subMonth()->format('m');
        $records = Accounting::where(\DB::raw("MONTH(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), $month)
            ->where(\DB::raw("YEAR(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), date('Y'))->get();

        $income = Accounting::subtotalIncome($records);
        $expenditures = Accounting::subtotalExpenditures($records);
        $balance = $income - $expenditures;
        return $balance;
    }

    public static function storageFile($request, $record)
    {
        if($request->hasFile('pdf'))
        {
            $master = \Auth::user()->current_master->rfc;
            $year = date('Y', strtotime($request->get('date_payment')));
            $month = date('m', strtotime($request->get('date_payment')));
            $path = $master.'/'.$year.'/'.$month.'/accounting\/'.$record->id.'/';
            $request->file('pdf')->storeAs($path, $request->file('pdf')->getClientOriginalName(), 'qore');
        }

        if($request->hasFile('xml'))
        {
            $master = \Auth::user()->current_master->rfc;
            $year = date('Y', strtotime($request->get('date_payment')));
            $month = date('m', strtotime($request->get('date_payment')));
            $path = $master.'/'.$year.'/'.$month.'/accounting\/'.$record->id.'/';
            $request->file('pdf')->storeAs($path, $request->file('pdf')->getClientOriginalName(), 'qore');
        }

        return true;
    }

    public static function formattedQuery($data, $request)
    {
        if($request->hasFile('pdf'))
        {
            $data['pdf'] = $request->file('pdf')->getClientOriginalName();
        }
        if($request->hasFile('xml'))
        {
            $data['xml'] = $request->file('xml')->getClientOriginalName();
        }
        if($request->has('date_emition') == false)
        {
            $data['date_emition'] = $request->get('date_payment');
        }
        if($request->has('iva') == false)
        {
            $data['iva'] = 0.00;
        }
         
        return $data;
    }

    public static function getLastSixMonths()
    {
        $dates = array();

        $date_from = Carbon::now();
        $month_from = $date_from->subMonths(5)->startOfMonth()->format('Y-m-d');
        $dates[] = $month_from;

        $date_to = Carbon::now();
        $month_to = $date_to->endOfMonth()->format('Y-m-d');
        $dates[] = $month_to;

        return $dates;
    }

    public static function getChartDataset($elements)
    {
        $dataset = array();
        $data = array();
        $labels = array();
        for($i=0; $i < $elements; $i++)
        {
            $date_year = Carbon::now();
            $date_month = Carbon::now();
            $year = $date_year->subMonths($i)->format('Y');
            $month = $date_month->subMonths($i)->format('m');
            $name = $date_month->format('M');

            $records = Accounting::where(\DB::raw("MONTH(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), $month)
            ->where(\DB::raw("YEAR(DATE_FORMAT(date_payment, '%Y-%m-%d'))"), $year)->get();
            $income = Accounting::subtotalIncome($records);

            $data[] = $income;
            $labels[] = $name;
        }

        $dataset["data"] = array_reverse($data);
        $dataset["labels"] = array_reverse($labels);
        return $dataset;
    }

    public static function buildChart($dataset)
    {
         $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 160])
        ->labels($dataset['labels'])
        ->datasets([
            [
                "label" => "Ingresos $",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dataset['data'],
            ]
        ])
        ->options(['legend' => ['display' => false]]);

        return $chartjs;
    }
}
