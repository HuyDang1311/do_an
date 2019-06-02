<?php

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UpdateController extends ApiController
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
     * @param CustomerRepositoryInterface $repository CustomerRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CustomerRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request    Request
     * @param  int                      $customerId Id of customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $customerId)
    {
        $data = $request->only([
            'phone_number',
            'password',
            'name',
            'address',
            'email',
            'avatar',
        ]);

        try {
            $customer = $this->repository->update($data, $customerId);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.update_fail'));
        }

        return $this->responseSuccess('', $customer);
    }
}
