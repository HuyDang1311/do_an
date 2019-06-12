<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
{

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CarRepositoryInterface     $repository  CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $repository
    ) {
        $this->repository = $repository;
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
            $car = $this->repository->showCar($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.cars.show_fail')]);
        }

        return view('web.cars.edit')->with([
            'data' => $car,
            'types' => transArr(Car::$type),
            'seat' => Car::$seatNumber,
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
                'car_number_plates',
                'car_manufacturer',
                'seat_quantity',
                'type',
            ]);
            $company = $this->repository->updateCar($id, $data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.cars.update_fail')]);
        }

        return redirect('cars/show/' . $company->id);
    }
}
