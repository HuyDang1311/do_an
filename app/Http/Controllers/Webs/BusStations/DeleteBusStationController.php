<?php

namespace App\Http\Controllers\Webs\BusStations;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class DeleteBusStationController extends Controller
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
            $this->repository->delete($id);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.bus_station.delete_fail'));
            return back();
        }

        session()->flash('message_success', trans('message.bus_station.delete_success'));
        return redirect('/bus-stations/index');
    }
}
