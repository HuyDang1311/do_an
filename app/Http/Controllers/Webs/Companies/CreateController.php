<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * BusStationRepositoryInterface
     *
     * @var CompanyRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CompanyRepositoryInterface $repository BusStationRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CompanyRepositoryInterface $repository
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
        return view('web.companies.create');
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
            return back()->with(['error' => trans('message.companies.create_fail')]);
        }

        return redirect('companies/show/' . $busStation->id);
    }
}
