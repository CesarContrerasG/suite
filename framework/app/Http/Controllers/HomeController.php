<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Sentry\Master;
use App\Sentry\Configuration;
use App\Qore\Departament;
use App\Notification;
use App\Viewers;
use App\Helpers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->status == 0)
        {
            session()->flush();
            return redirect()->back();
        }
        $time = date('G');

        if($time >= 7 && $time <= 15){
            $classtime = "gradient-day";
        }elseif ($time >= 16 && $time <= 18 ) {
            $classtime = "gradient-afternoon";
        }else{
            $classtime = "gradient-night";
        }

        $master = auth()->user()->master_id;
        $today = date('Y-m-d');
        $views = Viewers::where('user_id', auth()->user()->id)->select('notification_id')->get();
        
        $configuration = Configuration::where('master_id', $master)->first();
        $notifications = Notification::where('master_id', $master)->where('date_show', '>=', $today)->whereNotIn('id', $views)->get();

        if(count($configuration) > 0){
            return view('Platform.home', compact('classtime', 'configuration', 'notifications'));
        }
        return view('Platform.home', compact('classtime', 'notifications'));
    }

    /*
    |--------------------------------------------------------------------------
    | Menu Personalización
    |--------------------------------------------------------------------------
    |
    | This file is where you may define all of the routes that are handled
    | by your application. Just tell Laravel the URIs it should respond
    | to using a Closure or controller method. Build something great!
    |
    */

    

    

}
