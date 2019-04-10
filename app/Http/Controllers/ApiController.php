<?php

namespace App\Http\Controllers;

use App\Repositories\Traits\EloquentTransactional;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        EloquentTransactional;

    /**
     * Return a new JSON response from the application.
     *
     * @param string       $message Message
     * @param string|array $data    Data
     * @param int          $status  Status code
     * @param array        $headers Headers
     *
     * @return JsonResponse;
     */
    public function responseSuccess(string $message, $data = [], $status = 200, array $headers = [])
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
     * @param string       $message Message
     * @param string|array $error   Error response
     * @param int          $status  Status code
     * @param array        $headers Headers
     *
     * @return JsonResponse;
     */
    public function responseError(string $message, $error = [], $status = 500, array $headers = [])
    {
        return response()->json([
            'status_code' => $status,
            'message' => $message,
            'errors' => $error,
        ], $status, $headers);
    }
}
