<?php

namespace App\Http\Controllers\JWTAuth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Http\Controllers\JWTAuth\AuthenticationController $authController
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request, AuthenticationController $authController)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset($this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ( $response == Password::PASSWORD_RESET ) {
            return $this->sendResetResponse($request, $response, $authController);
        }

        return $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @param  App\Http\Controllers\JWTAuth\AuthenticationController $authController
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response, $authController)
    {
        $authData = $this->authController->authenticate($request)->getContent();

        $data = array_merge(json_decode($authData, true), ['status' => trans($response)]);

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => trans($response)], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'password_confirmation', 'token');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
