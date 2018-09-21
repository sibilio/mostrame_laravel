<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Domain\ControlAccess\Dado;

/**
 * Middleware checa se o cliente está bloqueado por algum motivo
 */
class CheckBlock
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
        if(Dado::get('empresa bloqueada')==='sim'){
           if(!Auth::user()->isMaster() && !Auth::user()->isMasterOne()){
              Auth::logout();
               return redirect()->route('fora-de-servico');
           }
        }
           
        return $next($request);
    }
}
