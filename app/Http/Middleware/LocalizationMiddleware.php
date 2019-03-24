<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Closure                 $next    Closure
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('language')) {
            $translator = $request->get('language', 'en');
        } else {
            $translator = $request->header('Language', 'en');
        }
        
        app('translator')->setLocale($translator);

        return $next($request);
    }
}
