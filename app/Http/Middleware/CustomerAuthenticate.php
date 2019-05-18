<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthenticate extends Authenticate
{

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        parent::__construct($auth);
        Config::set('jwt.user', Customer::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]]);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request Request
     *
     * @return string
     */
    protected function redirectTo($request)
    {
        return response()->json([
            'status_code' => Response::HTTP_UNAUTHORIZED,
            'message' => trans('auth.customer.login_fail'),
            'errors' => [],
        ], Response::HTTP_UNAUTHORIZED, []);
    }
}
