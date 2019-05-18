<?php
namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Config;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class LoginController extends ApiController
{

    /**
     * Constructor.
     *
     * @return void
     */
    function __construct()
    {
        Config::set('jwt.user', User::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ]]);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        Config::set( 'jwt.user', 'App\Models\User' );
        Config::set( 'auth.providers.users.model', User::class );
        $credentials = $request->only('username', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = new UserResource(Auth::user());
            return $this->responseSuccess('', $user)
                ->header('Authorization', $token);
        }

        return $this->responseError(trans('auth.failed'), [], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Auth guard
     *
     * @return mixed
     */
    private function guard()
    {
        return Auth::guard();
    }
}
