<?php

namespace App\Http\Controllers\Apis\BusStations;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateBusStationController extends ApiController
{

    /**
     * BusStationRepositoryInterface
     *
     * @var BusStationRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param BusStationRepositoryInterface $repository BusStationRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        BusStationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Create bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $data = $request->only([
                'city',
                'name_station',
                'parent_id'
            ]);

            $busStation = $this->repository->insert($data);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.bus_station.create_fail'));
        }

        return $this->responseSuccess('', $busStation);
    }
}
