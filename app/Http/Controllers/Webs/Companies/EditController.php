<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
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
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $busStation = $this->repository->showBusStation($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.companies.show_fail')]);
        }

        return view('web.companies.edit')->with([
            'data' => $busStation->toArray()
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
            return back()->with(['error' => trans('message.companies.update_fail')]);
        }

        return redirect('companies/show/' . $busStation->id);
    }
}
