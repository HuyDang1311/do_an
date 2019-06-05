<?php

namespace App\Http\Controllers\Webs\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowController extends Controller
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
     * Show order
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $order = $this->repository->find($id);
        } catch (Exception $ex) {
            return back()->with(trans('message.orders.show_fail'));
        }

        return view('web.orders.show')
            ->with(['data' => $order]);
    }
}
