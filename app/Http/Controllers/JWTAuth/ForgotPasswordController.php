<?php

namespace App\Http\Controllers\JWTAuth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Attach password reset route to the user model
        User::$passwordResetRoute = $request->get('route');

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink($request->only('email'));

        if ( $response == Password::RESET_LINK_SENT ) {
            return $this->sendResetLinkResponse($response);
        }

        return $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendResetLinkResponse($response)
    {
        return response()->json(['status' => trans($response)], Response::HTTP_OK);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => trans($response)], Response::HTTP_BAD_REQUEST);
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
}
