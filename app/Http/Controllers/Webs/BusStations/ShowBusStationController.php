<?php

namespace App\Http\Controllers\Webs\BusStations;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowBusStationController extends Controller
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
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $busStation = $this->repository->showBusStation($id);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.bus_station.show_fail'));
        }

        return $this->responseSuccess('', $busStation);
    }
}
