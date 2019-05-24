<?php

namespace App\Http\Controllers\Apis\BusStations;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class UpdateBusStationController extends ApiController
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
     * Update bus stations
     *
     * @param Request $request Request
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $data = $request->only([
                'city',
                'name_station',
                'parent_id'
            ]);
            $busStation = $this->repository->update($data, $id);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.bus_station.update_fail'));
        }

        return $this->responseSuccess(trans('message.bus_station.update_success'), $busStation);
    }
}
