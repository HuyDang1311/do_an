<?php
namespace App\Http\Controllers\Apis\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Resources\UserResource;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class LoginController extends AuthController
{

    /**
     * Handle the incoming request.
     *
     * @param Request $request Request
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

        return $this->responseError('', trans('auth.failed'), Response::HTTP_UNAUTHORIZED);
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
