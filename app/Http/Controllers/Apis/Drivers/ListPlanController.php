<?php

namespace App\Http\Controllers\Apis\Drivers;

use App\Http\Controllers\ApiController;
use App\Models\Plan;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
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
     * Handle the incoming request.
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $driverId = $request->get('driver_id');
            $type = $request->get('type', Plan::TYPE_NOW_DAY_PLAN);

            $plans = $this->repository->listDriverPlan($driverId, $type);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return $this->responseError(trans('message.driver.list_plan_fail'));
        }

        return $this->responseSuccess('', $plans);
    }
}
