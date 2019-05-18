<?php
namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource as UserResource;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class InfoController extends ApiController
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
        $user = new UserResource(Auth::user());

        return $this->responseSuccess('', $user);
    }
}
