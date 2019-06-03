<?php

namespace App\Http\Controllers\Webs\BusStations;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditBusStationController extends Controller
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
     * Show form update bus stations
     *
     * @param Request $request Request
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $busStation = $this->repository->showBusStation($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.bus_station.show_fail')]);
        }

        return view('web.bus-stations.edit')->with([
            'data' => $busStation
        ]);
    }

    /**
     * Update bus stations
     *
     * @param Request $request Request
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->only([
                'city',
                'name_station',
                'latitude',
                'longitude',
            ]);
            $busStation = $this->repository->updateBusStation($id, $data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.bus_station.update_fail')]);
        }

        return redirect('bus-stations/show/' . $busStation->id);
    }
}
