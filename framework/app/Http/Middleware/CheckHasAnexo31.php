<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasAnexo31
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
        if(!\Auth::user()->departament->company->has_anexo31)
        {
            return redirect("home");
        }
        return $next($request);
    }
}
