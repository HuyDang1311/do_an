<?php

namespace App\Http\Controllers\Apis\BusStations;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;

class ListBusStationController extends ApiController
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
     * List bus stations
     *
     * @return JsonResponse
     */
    public function handle()
    {
        try {
            $busStations = $this->repository->all([
                'id',
                'city',
                'name_station',
            ]);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.bus_station.list_fail'));
        }

        return $this->responseSuccess('', $busStations);
    }
}
