<?php

namespace App\Http\Controllers\Apis\Orders;

use App\Http\Controllers\Apis\AuthCustomer\CustomerAuthController;
use App\Models\Order;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CancelOrderController extends CustomerAuthController
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
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Show order
     *
     * @param Request $request Request
     * @param int     $id      Id of plan
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $status = $request->get('status', Order::STATUS_CANCEL);
            $this->repository->cancelOrder($id, $status);
        } catch (ModelNotFoundException $ex) {
            return $this->responseError(trans('message.order.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.order.cancel_fail'));
        }

        return $this->responseSuccess(trans('message.order.cancel_success'), []);
    }
}
