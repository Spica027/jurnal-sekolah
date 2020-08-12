<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class isKetua
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
        if (Auth::user()->role == "1") {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
