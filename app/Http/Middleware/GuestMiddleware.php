<?php

namespace App\Http\Middleware;

use App\Helpers\GuestHelper;
use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
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
        new GuestHelper;
        return $next($request);
    }
}
