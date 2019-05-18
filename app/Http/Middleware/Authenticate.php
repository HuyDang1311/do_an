<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request   Request
     * @param  \Closure                 $next      Closure
     * @param  string[]                 ...$guards Guards
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if(!$this->authenticate($request, $guards)) {
            return $this->redirectTo($request);
        }

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request $request Request
     * @param  array                    $guards  Guards
     *
     * @return mixed
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
                return true;
            }
        }

        return false;
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
            'message' => trans('auth.auth.login_fail'),
            'errors' => [],
        ], Response::HTTP_UNAUTHORIZED, []);
    }
}
