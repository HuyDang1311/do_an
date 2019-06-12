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
     * @param DriverRepositoryInterface  $repository  DriverRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        DriverRepositoryInterface $repository
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
            return view('web.drivers.create');
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
            ]);
            $data['company_id'] = Auth::user()->company_id;

            $car = $this->repository->createDriver($data);
        } catch (Exception $ex) {
            return back()->withErrors([trans('message.drivers.create_fail')]);
        }
        session()->flash('message', trans('message.drivers.create_success'));

        return redirect('drivers/show/' . $car->id);
    }
}
