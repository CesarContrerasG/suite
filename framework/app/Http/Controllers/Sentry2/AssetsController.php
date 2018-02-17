<?php

namespace App\Http\Controllers\Sentry;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Qore\Company;
use App\Activity;
use App\User;

class AssetsController extends Controller
{
    public function index()
    {
        $registers = Activity::select(\DB::raw("count(*) as activity, DATE_FORMAT(activities.created_at, '%Y-%m-%d') as date"))->groupBy("date")->get();
        $activities = array();
        $dates = array();
        $labels = array();
        foreach ($registers as $register) {
            $activities[] = $register->activity;
            $dates[] = $register->date;
            $labels[] = "";
        }

        $chartjs = app()->chartjs
            ->name('lineChartActivities')
            ->type('line')
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Daily Activity",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $activities,
                ]
            ])
            ->options(['legend' => ['display' => false]]);

        $users = User::count();
        $companies = Company::count();

        return view('Sentry.index', compact('chartjs', 'users', 'companies'));
    }
}
