<?php

namespace App\Http\Controllers\Webs\Plans;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BusStation\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowPlanController extends ApiController
{

    /**
     * PlanRepositoryInterface
     *
     * @var PlanRepositoryInterface
     */
    protected $repository;

    /**
     * BusStationRepositoryInterface
     *
     * @var CompanyRepositoryInterface
     */
    protected $repoBusStation;

    /**
     * Constructor.
     *
     * @param PlanRepositoryInterface    $repository     PlanRepositoryInterface
     * @param CompanyRepositoryInterface $repoBusStation BusStationRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        PlanRepositoryInterface $repository,
        CompanyRepositoryInterface $repoBusStation
    ) {
        $this->repository = $repository;
        $this->repoBusStation = $repoBusStation;
    }

    /**
     * Show plan
     *
     * @param Request $request Request
     * @param int     $id      Id of plan
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $plan = $this->repository->showPlan($id);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.plan.show_fail'));
        }

        return $this->responseSuccess('', $plan);
    }
}
