<?php

namespace App\Http\Controllers\Apis\Plans;

use App\Http\Controllers\ApiController;
use App\Models\Car;
use App\Models\Plan;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListPlanController extends ApiController
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
    public function handle(Request $request)
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

        return $this->responseSuccess('', $this->updateDataResult($plans));
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

    /**
     * Update result data
     *
     * @param array $plans Plans
     *
     * @return array
     */
    private function updateDataResult(array $plans)
    {
        array_walk($plans['items'], function (&$value) {
            $timeStart = Carbon::parse($value['time_start']);
            $timeEnd = Carbon::parse($value['time_end']);
            $value['time_between'] = $timeStart->diff($timeEnd)->format('%Hh%Ip');
            $value['time_start'] = $timeStart->format('H:i');
            $value['time_end'] = $timeEnd->format('H:i');
            $value['status_name'] = trans(Plan::$status[$value['status']] ?? '');
            $value['car_type_name'] = trans(Car::$type[$value['car_type']] ?? '');
            $value['seat_quantity_empty'] = max(
                intval($value['seat_quantity']) - count(json_decode($value['seat_ids']) ?? []),
                0
            );
        });

        return $plans;
    }
}
