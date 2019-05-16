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

class ShowPlanController extends ApiController
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
     * @param int     $id      Id of plan
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $plans = $this->repository->showPlan($id);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.plan.show_fail'));
        }

        return $this->responseSuccess('', $plans);
    }
}
