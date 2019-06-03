<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowController extends Controller
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
            return redirect('bus-stations/index')
                ->with(['error' => trans('message.companies.show_fail')]);
        }

        return view('web.companies.show')->with([
            'data' => $busStation->toArray()
        ]);
    }
}
