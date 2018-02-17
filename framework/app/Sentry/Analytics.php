<?php

namespace App\Sentry;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Activity;
use App\User;
use App\Qore\Company;

class Analytics extends Model
{
    public static function getCurrentYear()
    {
        $date = Carbon::now();
        $year = $date->format('Y');
        return $year;
    }

    public static function getLastYear()
    {
        $date = Carbon::now();
        $year = $date->subYear()->format('Y');
        return $year;
    }

    public static function getCurrentSemester()
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

    public static function getLastSemester()
    {
        $dates = array();

        $date_from = Carbon::now();
        $month_from = $date_from->subMonths(11)->startOfMonth()->format('Y-m-d');
        $dates[] = $month_from;

        $date_to = Carbon::now();
        $month_to = $date_to->subMonths(6)->endOfMonth()->format('Y-m-d');
        $dates[] = $month_to;

        return $dates;
    }

    public static function getCurrentTrimester()
    {
        $dates = array();

        $date_from = Carbon::now();
        $month_from = $date_from->subMonths(2)->startOfMonth()->format('Y-m-d');
        $dates[] = $month_from;

        $date_to = Carbon::now();
        $month_to = $date_to->endOfMonth()->format('Y-m-d');
        $dates[] = $month_to;

        return $dates;
    }

    public static function getLastTrimester()
    {
        $dates = array();

        $date_from = Carbon::now();
        $month_from = $date_from->subMonths(5)->startOfMonth()->format('Y-m-d');
        $dates[] = $month_from;

        $date_to = Carbon::now();
        $month_to = $date_to->subMonths(3)->endOfMonth()->format('Y-m-d');
        $dates[] = $month_to;

        return $dates;   
    }

    public static function getActivitiesForYear($year)
    {
        $activities = Activity::where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)->count();
        return $activities; 
    }

    public static function getCompaniesForYear($year)
    {
        $companies = Company::where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)->count();
        return $companies;
    }

    public static function getUsersForYear($year)
    {
        $users = User::where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)->count();
        return $users;
    }

    public static function getActivitiesForRange($range_array)
    {
        $activities = Activity::whereBetween(\DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), $range_array)->count();
        return $activities;
    }

    public static function getCompaniesForRange($range_array)
    {
        $companies = Company::whereBetween(\DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), $range_array)->count();
        return $companies;
    }

    public static function getUsersForRange($range_array)
    {
        $users = User::whereBetween(\DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), $range_array)->count();
        return $users;
    }

    public static function calculateGrowthRate($finalValue, $startValue)
    {
        $startValue = ($startValue <= 0) ? 1 : $startValue;
        $growth_rate = (($finalValue - $startValue) / $startValue) * 100;
        $growth_rate = ($growth_rate > 100) ? "+100" : $growth_rate;
        return $growth_rate;
    }

    public static function getGrowthRateAnual($model)
    {
        $rate_anual = 0;
        $last_year = Analytics::getLastYear();
        $current_year = Analytics::getCurrentYear();
        
        if($model == "activity")
        {
            $records_last_year = Analytics::getActivitiesForYear($last_year);
            $records_current_year = Analytics::getActivitiesForYear($current_year); 
        }
        elseif ($model == "company")
        {
            $records_last_year = Analytics::getCompaniesForYear($last_year);
            $records_current_year = Analytics::getCompaniesForYear($current_year);
        }
        elseif ($model == "user") {
            $records_last_year = Analytics::getUsersForYear($last_year);
            $records_current_year = Analytics::getUsersForYear($current_year);
        }
        
        $rate_anual = Analytics::calculateGrowthRate($records_current_year, $records_last_year);
        return $rate_anual;
    }

    public static function getGrowthRateBiannual($model)
    {
        $rate_biannual = 0;
        $current_semester = Analytics::getCurrentSemester();
        $last_semester = Analytics::getLastSemester();

        if($model == "activity")
        {
            $records_current_semester = Analytics::getActivitiesForRange($current_semester);
            $records_last_semester = Analytics::getActivitiesForRange($last_semester);
        }
        elseif($model == "company")
        {
            $records_current_semester = Analytics::getCompaniesForRange($current_semester);
            $records_last_semester = Analytics::getCompaniesForRange($last_semester);
        }
        elseif ($model == "user") {
            $records_current_semester = Analytics::getUsersForRange($current_semester);
            $records_last_semester = Analytics::getUsersForRange($last_semester);
        }

        $rate_biannual = Analytics::calculateGrowthRate($records_current_semester, $records_last_semester);
        return $rate_biannual;
    }

    public static function getGrowthRateQuarterly($model)
    {
        $rate_quarterly = 0;
        $current_trimester = Analytics::getCurrentTrimester();
        $last_trimester = Analytics::getLastTrimester();

        if($model == "activity")
        {
            $records_current_trimester = Analytics::getActivitiesForRange($current_trimester);
            $records_last_trimester = Analytics::getActivitiesForRange($last_trimester);
        }
        elseif($model == "company")
        {
            $records_current_trimester = Analytics::getCompaniesForRange($current_trimester);
            $records_last_trimester = Analytics::getCompaniesForRange($last_trimester);
        }
        elseif ($model == "user") {
            $records_current_trimester = Analytics::getUsersForRange($current_trimester);
            $records_last_trimester = Analytics::getUsersForRange($last_trimester);
        }

        $rate_quarterly = Analytics::calculateGrowthRate($records_current_trimester, $records_last_trimester);
        return $rate_quarterly;
    }

    public static function buildChart($type, $name, $labels, $data, $legend, $color)
    {
        $chartjs = "";
        if($type == 'line')
        {
            $chartjs = app()->chartjs
                ->name($name)
                ->type('line')
                ->size(['width' => 400, 'height' => 240])
                ->labels($labels)
                ->datasets([
                    [
                        "label" => $legend,
                        'backgroundColor' => "rgba({$color}, 0.31)",
                        'borderColor' => "rgba({$color}, 0.7)",
                        "pointBorderColor" => "rgba({$color}, 0.7)",
                        "pointBackgroundColor" => "rgba({$color}, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $data,
                    ]
                ])
                ->options(['legend' => ['display' => false]]);
        } 
        elseif($type == 'bar')
        {
            $colors = array();
            foreach($labels as $label)
            {
                $colors[] = "rgba({$color}, 0.7)";                    
            }

            $chartjs = app()->chartjs
                ->name($name)
                ->type('bar')
                ->size(['width' => 400, 'height' => 225])
                ->labels($labels)
                ->datasets([
                    [
                        "label" => $legend,
                        'backgroundColor' => $colors,
                        'data' => $data
                    ],
                ])
                ->options(['legend' => ['display' => false]]);
        }
        else 
        {
            $chartjs = "Tipo de Grafica no existente";
        }
        return $chartjs;
    }

    public static function getChartDataset($model, $elements)
    {
        $dataset = array();
        $data = array();
        $labels = array();
        for ($i=0; $i < $elements; $i++) 
        {
            $date_year = Carbon::now();
            $date_month = Carbon::now();
            $year = $date_year->subMonths($i)->format('Y');
            $month = $date_month->subMonths($i)->format('m');
            $name = $date_month->format('M');
            if($model == "activity")
            {
                $records = Activity::where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $month)
                    ->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)
                    ->count();
            }
            elseif ($model == "company") {
                $records = Company::where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $month)
                    ->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)
                    ->count();
            }
            elseif ($model == "user") {
                $records = User::where(\DB::raw("MONTH(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $month)
                    ->where(\DB::raw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d'))"), $year)
                    ->count();
            }
            $data[] = $records;
            $labels[] = $name;
        }

        $dataset["data"] = array_reverse($data);
        $dataset["labels"] = array_reverse($labels);
        return $dataset;
    }
}
