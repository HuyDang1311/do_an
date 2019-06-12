<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function attemptLogin(Request $request)
    {
        $result = $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
        $user = $this->guard();

        if (!$user || !$user->user()
            || ($user->user()->role != User::ROLE_SUPER_ADMIN && $user->user()->role != User::ROLE_ADMIN)) {
            $this->guard()->logout();
            return $this->sendFailedLoginResponse($request);
        }

        return $result;
    }
}
