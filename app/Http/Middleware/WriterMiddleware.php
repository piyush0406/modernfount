<?php

namespace App\Http\Middleware;

use Closure;

class WriterMiddleware
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
        if ($request->user() && $request->user()->role != 2){
            return redirect('signin');
        }
        else if(!$request->user()){
            return redirect('signin');
        }
        return $next($request);
    }
}
