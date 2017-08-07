<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Illuminate\Http\Response;

class JWTAuthenticate
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
        if ( ! $token = JWTAuth::setRequest($request)->getToken() ) {
            return response(['message' => trans('auth.token_invalid')], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = JWTAuth::authenticate($token);
        } catch (\Exception $e) {
            return response(['message' => trans('auth.token_invalid')], Response::HTTP_BAD_REQUEST);
        }

        if ( ! $user ) {
            return response(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
