<?php

namespace App\Http\Controllers\Webs\Drivers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * DriverRepositoryInterface
     *
     * @var DriverRepositoryInterface
     */
    protected $repository;

    /**
     * CompanyRepositoryInterface
     *
     * @var CompanyRepositoryInterface
     */
    protected $repoCompany;

    /**
     * Constructor.
     *
     * @param DriverRepositoryInterface  $repository  DriverRepositoryInterface
     * @param CompanyRepositoryInterface $repoCompany CompanyRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        DriverRepositoryInterface $repository,
        CompanyRepositoryInterface $repoCompany
    ) {
        $this->repository = $repository;
        $this->repoCompany = $repoCompany;
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
                'name',
                'email',
                'address',
                'company_id',
            ]);

            $companies = $this->repoCompany->listCompany();
            $drivers = $this->repository->listDriver($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.drivers.list_fail'));
            return back()->with(trans('message.drivers.list_fail'));
        }

        return view('web.drivers.index')->with([
            'input' => $data,
            'data' => $drivers,
            'companies' => $companies,
        ]);
    }
}
