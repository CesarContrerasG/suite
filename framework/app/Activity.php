<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $connection = 'mysql';
    public static function record($action, Model $model = null)
    {
        if($model instanceof Activity || auth()->guest()){
            return null;
        }

        $activity = new Activity;
        $activity->action = $action;

        if($model){
            $activity->model_class = get_class($model);
            $activity->model_id = $model->id;
        }

        auth()->user()->activities()->save($activity);
    }

    public static function chartUserActivities($user)
    {        
        $registers = Activity::select(\DB::raw("count(*) as activity, DATE_FORMAT(activities.created_at, '%Y-%m-%d') as date"))
            ->where('user_id', $user->id)
            ->groupBy("date")
            ->get();

        $activities = array();
        $dates = array();
        $labels = array();
        foreach ($registers as $register) {
            $activities[] = $register->activity;
            $dates[] = $register->date;
            $labels[] = "";
        }

        $chartjs = app()->chartjs
        ->name('lineChartActivityUser')
        ->type('line')
        ->labels($labels)
        ->datasets([
            [
                "label" => "Actividad de {$user->fullname}",
                'backgroundColor' => "rgba(155, 89, 182, 0.31)",
                'borderColor' => "rgba(155, 89, 182, 0.7)",
                "pointBorderColor" => "rgba(155, 89, 182, 0.7)",
                "pointBackgroundColor" => "rgba(155, 89, 182, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $activities,
            ]
        ])
        ->options(['legend' => ['display' => false]]);

        return $chartjs;
    }
}
