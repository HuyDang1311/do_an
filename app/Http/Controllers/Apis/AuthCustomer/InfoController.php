<?php
namespace App\Http\Controllers\Apis\AuthCustomer;

use App\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class InfoController extends CustomerAuthController
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
        $user = new CustomerResource(Auth::user());

        return $this->responseSuccess('', $user);
    }
}
