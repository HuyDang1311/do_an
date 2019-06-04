<?php

namespace App\Http\Controllers\Webs\Drivers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
     */
    protected $repository;

    /**
     * DriverRepositoryInterface
     *
     * @var DriverRepositoryInterface
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
            $companies = $this->repoCompany->listCompany();
            return view('web.drivers.create')
                ->with([
                    'companies' => $companies,
                ]);
        } catch (Exception $ex) {
            return back()->with(trans('message.drivers.create_fail'));
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
                'name',
                'email',
                'username',
                'address',
                'phone_number',
                'password',
                'company_id',
            ]);

            $car = $this->repository->createDriver($data);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return back()->with(['error' => trans('message.drivers.create_fail')]);
        }

        return redirect('drivers/show/' . $car->id);
    }
}
