<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * CustomerRepositoryInterface
     *
     * @var CustomerRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CustomerRepositoryInterface  $repository  CustomerRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CustomerRepositoryInterface $repository
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
            return view('web.customers.create');
        } catch (Exception $ex) {
            session()->flash('error', trans('message.customers.create_fail'));
            return back();
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
                'address',
                'phone_number',
                'password',
            ]);

            $car = $this->repository->createCustomer($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.customers.create_fail'));
            return back()->withInput();
        }

        session()->flash('message_success', trans('message.customers.create_success'));
        return redirect('customers/show/' . $car->id);
    }
}
