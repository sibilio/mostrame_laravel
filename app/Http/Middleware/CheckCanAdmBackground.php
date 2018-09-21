<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCanAdmBackground
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
        if(Auth::user()->cantDoIt('acessa.adm-background')){
           Auth::logout();
           return redirect()->route('login');
        }
        
        return $next($request);
    }
}
