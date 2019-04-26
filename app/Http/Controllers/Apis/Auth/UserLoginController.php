<?php
namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource as UserResource;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class UserLoginController extends ApiController
{

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
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
