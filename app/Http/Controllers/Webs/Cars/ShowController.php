<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowController extends Controller
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
     * @param CarRepositoryInterface $repository CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Show car
     *
     * @param Request $request Request
     * @param int     $id      Id of car
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $car = $this->repository->showCar($id);
        } catch (Exception $ex) {
            return redirect('cars/index')
                ->with(['error' => trans('message.cars.show_fail')]);
        }

        return view('web.cars.show')->with([
            'data' => $car
        ]);
    }
}
