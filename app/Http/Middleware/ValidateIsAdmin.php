<?php

namespace App\Http\Middleware;

use Closure;

class ValidateIsAdmin
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
        if (!Auth::user()->isAdmin)
            return back();
        return $next($request);
    }
}