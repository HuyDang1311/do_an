<?php

namespace App\Http\Controllers\Webs\Plans;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    /**
     * DriverRepositoryInterface
     *
     * @var DriverRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param DriverRepositoryInterface $repository DriverRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        DriverRepositoryInterface $repository
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
            $driver = $this->repository->showDriver($id);
        } catch (Exception $ex) {
            return redirect('drivers/index')
                ->with(['error' => trans('message.drivers.show_fail')]);
        }

        return view('web.drivers.show')->with([
            'data' => $driver
        ]);
    }
}
