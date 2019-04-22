<?php

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Exceptions\ValidatorException;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;

class ShowCustomerController extends ApiController
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
     * List announcements
     *
     * @param int $customerId Id of customer
     *
     * @return JsonResponse
     */
    public function handle($customerId)
    {
        try {
            $customer = $this->repository->find($customerId, [
                'phone_number',
                'name',
                'status',
                'created_at'
            ]);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.show_fail'));
        }

        return $this->responseSuccess('', $customer);
    }
}
