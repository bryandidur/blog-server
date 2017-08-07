<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Illuminate\Http\Response;

class JWTRefreshToken
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
        $response = $next($request);
        $token = JWTAuth::getToken();

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (\Exception $e) {
            return response()->json(['message' => trans('auth.token_invalid')], Response::HTTP_BAD_REQUEST);
        }

        // send the refreshed token back to the client
        $response->headers->set('Authorization', 'Bearer ' . $refreshedToken);

        return $response;
    }
}
