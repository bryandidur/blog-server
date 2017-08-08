<?php

namespace App\Http\Middleware;

use Closure;

class AlwaysExpectsJson
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
        // Add json to acceptable response
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
