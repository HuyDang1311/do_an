<?php

namespace App\Http\Controllers\Webs\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CancelController extends Controller
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
     * List bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $status = $request->get('status', Order::STATUS_CANCEL);
            $this->repository->cancelOrder($id, $status);
        } catch (Exception $ex) {
            return back()->with(trans('message.orders.cancel_fail'));
        }

        return redirect('orders/index');
    }
}
