<?php

namespace App\Http\Controllers\Webs\Plans;

use App\Http\Controllers\Controller;
use App\Models\BusStation;
use App\Models\Plan;
use App\Models\User;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
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
    protected $repoCompany;

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
     * @param CompanyRepositoryInterface    $repoCompany    CompanyRepositoryInterface
     * @param DriverRepositoryInterface     $repoDriver     DriverRepositoryInterface
     * @param BusStationRepositoryInterface $repoBusStation BusStationRepositoryInterface
     * @param CarRepositoryInterface $repoCar CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        PlanRepositoryInterface $repository,
        CompanyRepositoryInterface $repoCompany,
        DriverRepositoryInterface $repoDriver,
        BusStationRepositoryInterface $repoBusStation,
        CarRepositoryInterface $repoCar
    ) {
        $this->repository = $repository;
        $this->repoCompany = $repoCompany;
        $this->repoDriver = $repoDriver;
        $this->repoBusStation = $repoBusStation;
        $this->repoCar = $repoCar;
    }

    /**
     * Show form update car
     *
     * @param Request $request Request
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $busStations = $this->repoBusStation->listBusStation(BusStation::TYPE_CITY);
            $companies = $this->repoCompany->listCompany();
            $drivers = $this->repoDriver->listDriver([]);
            $cars = $this->repoCar->listCar([]);
            $plan = $this->repository->find($id);
            return view('web.plans.edit')
                ->with([
                    'companies' => $companies,
                    'busStations' => $busStations,
                    'drivers' => $drivers,
                    'cars' => $cars,
                    'data' => $plan,
                    'status' => transArr(Plan::$status)
                ]);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.plans.show_fail')]);
        }
    }

    /**
     * Update car
     *
     * @param Request $request Request
     * @param int     $id      Id of car
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->only([
                'address_start_id',
                'address_end_id',
                'time_start',
                'time_end',
                'car_id',
                'user_driver_id',
                'company_id',
                'price_ticket',
                'status',
            ]);
            $plan = $this->repository->update($data, $id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.plans.update_fail')]);
        }

        return redirect('plans/show/' . $plan->id);
    }
}
