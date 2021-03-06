<?php

namespace App\Http\Controllers\Apis\BusStations;

use App\Http\Controllers\ApiController;
use App\Models\BusStation;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

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
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $type = intval($request->get('type', BusStation::TYPE_CITY));
            $busStations = $this->repository->listBusStation($type);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.bus_station.list_fail'));
        }

        return $this->responseSuccess('', $busStations);
    }
}
