<?php

namespace App\Http\Middleware;

use Closure;
use App\Sentry\Module;

class CheckHasModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $name = strtoupper(substr($request->route()->getPrefix(), 1));
        $app = Module::where('name', $name)->first();  
    
        if(!isset($request->id))      
            if(session()->has('company'))
                $id =  session()->get('company');
            else
                $id = auth()->user()->company_id;
        else            
            $id = \Hashids::connection('main')->decode($request->id)[0];

        session()->put('company', $id);
        $module = Module::find($app->id);
        $modules_company = $module->companies()->wherePivot('company_id', $id)->wherePivot('active', 1)->count();
        $modules_active = auth()->user()->companies()->wherePivot('company_id', $id)->wherePivot('module_id', $app->id)->wherePivot('active', 1)->count();

        if($modules_active == 0 || $modules_company == 0)
            return redirect("home");
        
      
        return $next($request);
    }
}
