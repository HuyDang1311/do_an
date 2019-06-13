<?php

namespace App\Http\Controllers\Webs\Plans;

use App\Http\Controllers\Controller;
use App\Models\BusStation;
use App\Models\Car;
use App\Models\Plan;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{

    /**
     * PlanRepositoryInterface
     *
     * @var PlanRepositoryInterface
     */
    protected $repository;

    /**
     * DriverRepositoryInterface
     *
     * @var DriverRepositoryInterface
     */
    protected $repoDriver;

    /**
     * BusStationRepositoryInterface
     *
     * @var BusStationRepositoryInterface
     */
    protected $repoBusStation;

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
     */
    protected $repoCar;

    /**
     * Constructor.
     *
     * @param PlanRepositoryInterface       $repository     PlanRepositoryInterface
     * @param DriverRepositoryInterface     $repoDriver     DriverRepositoryInterface
     * @param BusStationRepositoryInterface $repoBusStation BusStationRepositoryInterface
     * @param CarRepositoryInterface $repoCar CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        PlanRepositoryInterface $repository,
        DriverRepositoryInterface $repoDriver,
        BusStationRepositoryInterface $repoBusStation,
        CarRepositoryInterface $repoCar
    ) {
        $this->repository = $repository;
        $this->repoDriver = $repoDriver;
        $this->repoBusStation = $repoBusStation;
        $this->repoCar = $repoCar;
    }

    /**
     * Show form update bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function show(Request $request)
    {
        try {
            $busStations = $this->repoBusStation->listBusStation(BusStation::TYPE_CITY);
            $drivers = $this->repoDriver->listDriver([]);
            $cars = $this->repoCar->listCar([]);
            return view('web.plans.create')
                ->with([
                    'busStations' => $busStations,
                    'drivers' => $drivers,
                    'cars' => $cars,
                ]);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.plans.create_fail'));
            return back()->with(trans('message.plans.create_fail'));
        }
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
                'address_start_id',
                'address_end_id',
                'time_start',
                'time_end',
                'car_id',
                'user_driver_id',
                'price_ticket',
            ]);

            $data['status'] = Plan::STATUS_USING;
            $data['company_id'] = Auth::user()->company_id;
            $plan = $this->repository->create($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.plans.create_fail'));
            return back()->withInput($data);
        }

        session()->flash('message_success', trans('message.plans.create_success'));
        return redirect('plans/show/' . $plan->id);
    }
}
