<?php

namespace App\Http\Controllers\Webs\Drivers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
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
            $driver = $this->repository->showDriver($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.drivers.show_fail')]);
        }

        return view('web.drivers.edit')->with([
            'data' => $driver,
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
                'status',
            ]);
            $data['company_id'] = Auth::user()->company_id;
            $company = $this->repository->updateDriver($id, $data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.drivers.update_fail')]);
        }

        return redirect('drivers/show/' . $company->id);
    }
}
