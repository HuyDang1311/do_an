<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
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
            return view('web.cars.create')
                ->with([
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
                'seat_quantity',
                'type',
            ]);
            $data['company_id'] = Auth::user()->company_id;

            $car = $this->repository->createCar($data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.cars.create_fail')]);
        }

        return redirect('cars/show/' . $car->id);
    }
}
