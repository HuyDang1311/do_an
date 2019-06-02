<?php

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends ApiController
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
     * @param int $customerId Id of customer
     *
     * @return JsonResponse
     */
    public function __invoke($customerId)
    {
        try {
            $customer = $this->repository->find($customerId, [
                'phone_number',
                'name',
                'address',
                'email',
                'avatar',
                'status',
                'created_at'
            ]);
        } catch (ModelNotFoundException $ex) {
            return $this->responseError(trans('message.customer.not_found'), [], Response::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.show_fail'));
        }

        return $this->responseSuccess('', $customer);
    }
}
