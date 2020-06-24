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

        $slug = actionPath();
        $verify = verifyAccessRoute($slug);
        
        if($verify){
            return $next($request);
        }else{
            abort(403);
            // return 'Vista no definida <a href="'.url('/').'">Atras</a>';
        }

        
    }
}
