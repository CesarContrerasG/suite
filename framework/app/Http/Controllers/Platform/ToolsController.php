<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sentry\Configuration;
use App\Helpers;
use App\Notification;

use Validator;

class ToolsController extends Controller 
{
    public function parameters()
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $master = auth()->user()->current_master->id;
        $configuration = Configuration::where('master_id', $master)->first();
        if(count($configuration) > 0){
            return view('Platform.configuration', compact('configuration'));
        }
        return view('Platform.configuration');
    }

    public function configuration(Request $request)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $validator = Validator::make($request->all(), [
            'website' => 'nullable|min:6|max:30',
            'primary_color' => 'nullable|min:7|max:7',
            'secundary_color' => 'nullable|min:7|max:7',
            'contact_support' => 'nullable|min:3|max:30',
            'email_support' => 'nullable|email',
            'contact_sales' => 'nullable|min:3|max:30',
            'email_sales' => 'nullable|email',
            'contact_admon' => 'nullable|min:3|max:30',
            'email_admon' => 'nullable|email',
            'configuration_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $configuration = Configuration::find($request->get('configuration_id'));
        $configuration->website = $request->get('website');
        $configuration->primary_color = $request->get('primary_color');
        $configuration->secundary_color = $request->get('secundary_color');
        $configuration->contact_support = $request->get('contact_support');
        $configuration->email_support = $request->get('email_support');
        $configuration->contact_sales = $request->get('contact_sales');
        $configuration->email_sales = $request->get('email_sales');
        $configuration->contact_admon = $request->get('contact_admon');
        $configuration->email_admon = $request->get('email_admon');
        $configuration->save();

        return redirect('/home');
    }

    /*
    |--------------------------------------------------------------------------
    | Menu Notificaciones
    |--------------------------------------------------------------------------
    |
    | This file is where you may define all of the routes that are handled
    | by your application. Just tell Laravel the URIs it should respond
    | to using a Closure or controller method. Build something great!
    |
    */

    public function notifications()
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $master_account = auth()->user()->current_master->id;
        $notifications = Notification::where('master_id', $master_account)->get();
        return view('Platform.notifications.index', compact('notifications'));
    }

    public function createNotification()
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        return view('Platform.notifications.create');
    }

    public function storeNotification(Request $request)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $validator = Validator::make($request->all(), [
            'master_id' => 'required|integer',
            'notification_title' => 'required|max:30',
            'notification' => 'required|string',
            'date_show' => 'required|date',
            'date_hide' => 'required|date|after:date-show'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Notification::create($request->all());
        return redirect()->route('platform.notifications.index');
    }

    public function editNotification(Notification $notification)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        return view('Platform.notifications.edit', compact('notification'));
    }

    public function updateNotification(Notification $notification, Request $request)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $validator = Validator::make($request->all(), [
            'master_id' => 'required|integer',
            'notification_title' => 'required|max:30',
            'notification' => 'required|string',
            'date_show' => 'required|date',
            'date_hide' => 'required|date|after:date-show'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $notification->fill($request->all());
        $notification->save();
        return redirect()->route('platform.notifications.index');
    }

    public function deleteNotification(Notification $notification, Request $request)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }

        $notification->restore();
        $notification->delete();
        return redirect()->route('platform.notifications.index');
    }

    public function show($id, $module)
    {
        if(auth()->user()->is_master_user == false)
        {
            \Session::flash("announcement", "Al parecer no tienes los permisos requeridos para entrar a este apartado de la plataforma");
            \Session::flash("announcement-title", "UPPS!! USUARIO NO VALIDO");
            return redirect()->route('suite.platform.index');
        }
        
        $master = Master::find($id);
        $companies = $master->companies()->where('type',1)->get();
        $modules = Module::find($module);
        session()->put('level',4);
        
        return view('Platform.home_support')->with(['companies'=>$companies,'url'=>$modules->url]);
    }
}
