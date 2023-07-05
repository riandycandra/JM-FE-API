<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponses;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $isApiRequest = in_array('api',$request->route()->getAction('middleware'));

        if($isApiRequest)
        {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message'=> 'API Token is required.'
            ], 401));
        } else {
            Auth::guard('web')->logout();
            return Redirect::to(url('/login'))->send();
        }
    }
}
