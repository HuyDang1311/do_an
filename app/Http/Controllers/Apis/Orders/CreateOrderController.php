<?php

namespace App\Http\Controllers\Apis\Orders;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOrderController extends ApiController
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
            ]);

            $this->beginTransaction();

            $order = $this->repository->createOrder($data);

            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            return $this->responseError(trans('message.order.create_fail'));
        }

        return $this->responseSuccess('', $order, Response::HTTP_CREATED);
    }
}
