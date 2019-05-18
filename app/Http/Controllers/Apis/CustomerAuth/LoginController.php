<?php
namespace App\Http\Controllers\Apis\CustomerAuth;

use App\Http\Controllers\ApiController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Config;

class LoginController extends ApiController
{

    /**
     * Constructor.
     *
     * @return void
     */
    function __construct()
    {
        Config::set('jwt.user', Customer::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Customer::class,
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
        $credentials = $request->only('phone_number', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = new CustomerResource(Auth::user());
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
