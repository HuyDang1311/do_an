<?php

namespace App\Http\Controllers\Webs\Plans;

use App\Http\Controllers\Controller;
use App\Models\BusStation;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
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
     * Constructor.
     *
     * @param PlanRepositoryInterface       $repository     PlanRepositoryInterface
     * @param CompanyRepositoryInterface    $repoCompany    CompanyRepositoryInterface
     * @param DriverRepositoryInterface     $repoDriver     DriverRepositoryInterface
     * @param BusStationRepositoryInterface $repoBusStation BusStationRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        PlanRepositoryInterface $repository,
        CompanyRepositoryInterface $repoCompany,
        DriverRepositoryInterface $repoDriver,
        BusStationRepositoryInterface $repoBusStation
    ) {
        $this->repository = $repository;
        $this->repoCompany = $repoCompany;
        $this->repoDriver = $repoDriver;
        $this->repoBusStation = $repoBusStation;
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
                'address_start_id',
                'address_end_id',
                'user_driver_id',
                'company_id',
            ]);

            $busStations = $this->repoBusStation->listBusStation(BusStation::TYPE_CITY);
            $companies = $this->repoCompany->listCompany();
            $drivers = $this->repoDriver->listDriver([]);
            $plans = $this->repository->getPlans($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.plans.list_fail'));
            return back()->withInput($data);
        }

        return view('web.plans.index')->with([
            'input' => $data,
            'data' => $plans,
            'drivers' => $drivers,
            'companies' => $companies,
            'busStations' => $busStations,
        ]);
    }
}
