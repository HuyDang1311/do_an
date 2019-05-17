<?php

namespace App\Http\Controllers\Apis\Orders;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowOrderController extends ApiController
{

    /**
     * OrderRepositoryInterface
     *
     * @var OrderRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param OrderRepositoryInterface $repository OrderRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        OrderRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * List plan
     *
     * @param Request $request Request
     * @param int     $id      Id of plan
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $plans = $this->repository->showOrder($id);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.order.show_fail'));
        }

        return $this->responseSuccess('', $plans);
    }
}
