<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasSentry
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
        session()->put('prefix', strtoupper(substr($request->route()->getPrefix(), 1)));
        if(!\Auth::user()->departament->company->has_module)
        {
            return redirect("home");
        }

        session()->forget('prefix');
        return $next($request);
    }
}
