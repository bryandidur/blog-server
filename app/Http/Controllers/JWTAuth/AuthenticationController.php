<?php

namespace App\Http\Controllers\JWTAuth;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    use ThrottlesLogins;

    /**
     * Handle an authentication token request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        // Checks if has too many authentication attempts, by username and client IP address
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ( ! $token = JWTAuth::attempt($request->only([$this->username(), 'password'])) ) {
            // Increments authentication attempts
            $this->incrementLoginAttempts($request);

            return response()->json(['message' => trans('auth.failed')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->sendAuthenticationResponse($request, $token);
    }

    /**
     * Handle an authentication token refresh request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        $token = JWTAuth::getToken();

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (\Exception $e) {
            return response()->json(['message' => trans('auth.token_invalid')], Response::HTTP_BAD_REQUEST);
        }

        return $this->sendAuthenticationResponse($request, $refreshedToken);
    }

    /**
     * Handle an unauthentication token request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unAuthenticate()
    {
        $token = JWTAuth::getToken();

        try {
            JWTAuth::invalidate($token);
        } catch (\Exception $e) {
            return response()->json(['message' => trans('auth.token_invalid')], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['success' => true], Response::HTTP_OK);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendAuthenticationResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::getPayload($token)->get('exp'),
            'user' => JWTAuth::toUser($token),
        ];

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Sends a lockout response to the client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return response()->json(['message' => trans('auth.throttle', ['seconds' => $seconds])], Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username()
    {
        return 'email';
    }
}
