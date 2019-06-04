<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
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
            return view('web.cars.create')
                ->with([
                    'companies' => $companies,
                    'types' => transArr(Car::$type),
                    'seat' => Car::$seatNumber,
                ]);
        } catch (Exception $ex) {
            return back()->with(trans('message.cars.create_fail'));
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
                'car_number_plates',
                'car_manufacturer',
                'company_id',
                'seat_quantity',
                'type',
            ]);

            $car = $this->repository->createCar($data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.cars.create_fail')]);
        }

        return redirect('cars/show/' . $car->id);
    }
}
