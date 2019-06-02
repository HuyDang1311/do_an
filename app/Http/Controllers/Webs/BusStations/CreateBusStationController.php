<?php

namespace App\Http\Controllers\Webs\BusStations;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateBusStationController extends Controller
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
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        return view('web.bus-stations.create');
    }

    /**
     * Create bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $data = $request->only([
                'city',
                'name_station',
                'latitude',
                'longitude',
            ]);
            $busStation = $this->repository->createBusStation($data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.bus_station.create_fail')]);
        }

        return redirect('bus-stations/show/' . $busStation->id);
    }
}
