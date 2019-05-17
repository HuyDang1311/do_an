<?php

namespace App\Http\Controllers\Apis\Orders;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateOrderController extends ApiController
{

    /**
     * PlanRepositoryInterface
     *
     * @var PlanRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param PlanRepositoryInterface $repository PlanRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        PlanRepositoryInterface $repository
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
            $searchData = $request->only([
                'address_start_id',
                'address_end_id',
                'time_start',
            ]);

            $plans = $this->repository->listPlan(
                $searchData,
                $this->getSortData($request),
                [
                    'per_page' => $request->get('per_page', 10)
                ]
            );
        } catch (Exception $ex) {
            return $this->responseError(trans('message.plan.list_fail'));
        }

        return $this->responseSuccess('', $plans);
    }

    /**
     * Get sort data
     *
     * @param Request $request Request
     *
     * @return array
     */
    private function getSortData(Request $request)
    {
        $sortData = [
            'sort_column' => $request->get('sort_column', 'time_start'),
            'sort_direction' => $request->get('sort_direction', 'asc'),
        ];

        return getSortConditions($sortData, [
            'time_start',
            'price_ticket'
        ], 'time_start');
    }
}
