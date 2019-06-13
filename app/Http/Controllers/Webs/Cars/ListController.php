<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
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
     * @param CarRepositoryInterface     $repository  CarRepositoryInterface
     * @param CompanyRepositoryInterface $repoCompany CompanyRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $repository,
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
                'car_number_plates',
                'car_manufacturer',
                'company_id',
                'type',
            ]);

            $companies = $this->repoCompany->listCompany();
            $cars = $this->repository->listCar($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.cars.list_fail'));
            return back()->withInput();
        }

        return view('web.cars.index')->with([
            'input' => $data,
            'data' => $cars,
            'companies' => $companies,
            'types' => transArr(Car::$type)
        ]);
    }
}
