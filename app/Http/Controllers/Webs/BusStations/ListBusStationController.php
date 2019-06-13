<?php

namespace App\Http\Controllers\Webs\BusStations;

use App\Http\Controllers\Controller;
use App\Models\BusStation;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListBusStationController extends Controller
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
            $data = $request->only([
                'city_name',
                'station_name',
            ]);

            $type = intval($request->get('type', BusStation::TYPE_BUS_STATION));

            $busStations = $this->repository->listBusStation($type, $data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.bus_station.list_fail'));
            return back()->withInput($data);
        }

        return view('web.bus-stations.index')->with([
            'input' => $data,
            'data' => $busStations->toArray()
        ]);
    }
}
