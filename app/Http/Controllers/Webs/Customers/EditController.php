<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
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
            $customer = $this->repository->showCustomer($id);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.customers.show_fail'));
            return back();
        }

        return view('web.customers.edit')->with([
            'data' => $customer,
            'statusObject' => transArr(Customer::$statusObject),
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
                'address',
                'phone_number',
                'password',
                'status',
            ]);
            $company = $this->repository->updateCustomer($id, $data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.customers.show_fail'));
            return back()->withInput($data);
        }

        session()->flash('message_success', trans('message.customers.update_success'));
        return redirect('customers/show/' . $company->id);
    }
}
