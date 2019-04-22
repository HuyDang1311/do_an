<?php

namespace App\Http\Controllers;

use App\Repositories\Traits\EloquentTransactional;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EloquentTransactional;

    /**
     * Return a new JSON response from the application.
     *
     * @param mixed        $message Message
     * @param string|array $data    Data
     * @param int          $status  Status code
     * @param array        $headers Headers
     *
     * @return JsonResponse;
     */
    public function responseSuccess($message, $data = [], $status = Response::HTTP_OK, array $headers = [])
    {
        return response()->json([
            'status_code' => $status,
            'message' => $message,
            'data' => $data,
        ], $status, $headers);
    }

    /**
     * Return a new JSON response from the application.
     *
     * @param mixed        $message Message
     * @param string|array $error   Error response
     * @param int          $status  Status code
     * @param array        $headers Headers
     *
     * @return JsonResponse;
     */
    public function responseError(
        $message,
        $error = [],
        $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $headers = []
    ) {
        return response()->json([
            'status_code' => $status,
            'message' => $message,
            'errors' => $error,
        ], $status, $headers);
    }
}
