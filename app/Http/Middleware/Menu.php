<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Symfony\Component\HttpFoundation\Response;

class Menu extends Middleware
{
    /**
     * Dispatcher
     *
     * @var Dispatcher
     */
    protected $evens;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(
        \Illuminate\Contracts\Auth\Factory $auth,
        Dispatcher $evens
    ) {
        $this->auth = $auth;
        $this->evens = $evens;
    }

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
        $user = Auth::user();

        if ($user && $user->role === User::ROLE_ADMIN) {

            $config = config('adminlte');

            $this->evens->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
                $menu = $config['menu1'];
                $event->menu->menu = [];
                call_user_func_array([$event->menu, 'add'], $menu);
            });
        }


        return $next($request);
    }
}
