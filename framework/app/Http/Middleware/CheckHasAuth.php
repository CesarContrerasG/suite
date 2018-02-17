<?php

namespace App\Http\Middleware;

use Closure;
use App\Qore\Company;
use App\Sentry\Module;

class CheckHasAuth
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

        $module_master = auth()->user()->master->suites()->where('active', 1)->where('module_id', $app->id)->count();
        
        if($module_master == 0)
        {
            return redirect("home");
        }
        else
        {

            if($name == "SENTRY")
            {

                if(auth()->user()->extra == NULL)
                {
                    return redirect("home");
                }
                else 
                {
                    $hash = \Hashids::connection('security')->decode(auth()->user()->extra);
                    if(count($hash) == 0)
                    {
                        return redirect("home");
                    }
                    elseif(auth()->user()->id != $hash[0])
                    {
                        return redirect("home");
                    } 
                }
            }

        }
                
        return $next($request);
    }
}
