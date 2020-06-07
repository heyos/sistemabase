<?php

namespace App\Http\Middleware;

use Closure;

class VerifyRouteSlug
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

        $verify = verifyAccessRoute();

        if($verify){
            return $next($request);
        }else{
            abort(403);
        }

        
    }
}
