<?php

namespace App\Http\Controllers\Webs\Orders;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
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
     * @param OrderRepositoryInterface  $repository  OrderRepositoryInterface
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
    public function __invoke(Request $request)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'address',
                'company_id',
            ]);

            $orders = $this->repository->listOrders($data);
        } catch (Exception $ex) {
            return back()->with(trans('message.orders.list_fail'));
        }

        return view('web.orders.index')->with([
            'input' => $data,
            'data' => $orders,
        ]);
    }
}
