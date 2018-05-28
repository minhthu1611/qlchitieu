<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$id)
    {
        if(Auth::guard('user')->check() && Auth::guard('user')->user()->level<=$id)
            return $next($request);
        else
            return redirect()->route('glogin');
    }
}
