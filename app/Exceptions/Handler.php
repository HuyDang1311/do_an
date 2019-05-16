<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     *
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        dd($exception->getTraceAsString());
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        return parent::render($request, $exception);

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'status_code' => Response::HTTP_METHOD_NOT_ALLOWED,
                'message' => trans('message.route_not_found'),
                'data' => [],
            ], Response::HTTP_METHOD_NOT_ALLOWED, []);
        }

        return response()->json([
            'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => 'Internal Error.',
            'data' => [],
        ], Response::HTTP_INTERNAL_SERVER_ERROR, []);
    }
}
