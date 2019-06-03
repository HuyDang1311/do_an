<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BusStation\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
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
            $this->repository->delete($id);
        } catch (Exception $ex) {
            return back()->withErrors(['error' => trans('message.companies.delete_fail')]);
        }

        return redirect('/companies/index');
    }
}
