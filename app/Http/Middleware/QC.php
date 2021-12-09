<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QC
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->QC){
            return $next($request);
        }
        
         abort(403,'UNAUTHORIZED ACCESS');
    }
}
