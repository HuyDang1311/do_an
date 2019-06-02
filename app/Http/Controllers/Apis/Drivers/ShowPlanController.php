<?php

namespace App\Http\Controllers\Apis\Drivers;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * Handle the incoming request.
     *
     * @param Request $request  Request
     * @param int     $driverId Id of driver
     * @param int     $planId   Id of plan
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $driverId, $planId)
    {
        try {
            $customer = $this->repository->showPlanOfDriver($driverId, $planId);
        } catch (ModelNotFoundException $ex) {
            return $this->responseError(trans('message.drivers.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.drivers.show_fail'));
        }

        return $this->responseSuccess('', $customer);
    }
}
