<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
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
            $companies = $this->repoCompany->listCompany();
            $driver = $this->repository->showDriver($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.drivers.show_fail')]);
        }

        return view('web.drivers.edit')->with([
            'data' => $driver,
            'companies' => $companies,
            'status' => transArr(User::$statusObject),
        ]);
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
                'name',
                'email',
                'username',
                'address',
                'phone_number',
                'password',
                'company_id',
                'status',
            ]);
            $company = $this->repository->updateCar($id, $data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.drivers.update_fail')]);
        }

        return redirect('drivers/show/' . $company->id);
    }
}
