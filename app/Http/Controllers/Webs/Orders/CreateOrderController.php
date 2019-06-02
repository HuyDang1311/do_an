<?php

namespace App\Http\Controllers\Webs\Orders;

use App\Http\Controllers\Apis\AuthCustomer\CustomerAuthController;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOrderController extends CustomerAuthController
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
     * List order
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $data = $request->only([
                'address_start_id',
                'address_end_id',
                'plan_id',
                'seat_ids',
                'order_code',
                'payment_method_id',
                'customer_id'
            ]);

            $this->beginTransaction();

            $order = $this->repository->createOrder($data);

            $this->commit();
        } catch (ModelNotFoundException $ex) {
            $this->rollback();
            return $this->responseError(trans('message.customer.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            $this->rollback();
            return $this->responseError(trans('message.order.create_fail'));
        }

        return $this->responseSuccess('', $order, Response::HTTP_CREATED);
    }
}
