<?php

namespace App\Http\Controllers\Webs\Orders;

use App\Http\Controllers\Apis\AuthCustomer\CustomerAuthController;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoryOrderController extends CustomerAuthController
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
     * Show history order
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $customerId = $request->get('customer_id');
            $historyOrder = $this->repository->historyOrder($customerId);
        } catch (ModelNotFoundException $ex) {
            return $this->responseError(trans('message.order.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.order.history_fail'));
        }

        return $this->responseSuccess('', $historyOrder);
    }
}
