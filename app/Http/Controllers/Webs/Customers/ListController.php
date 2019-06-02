<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController extends ApiController
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
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $customers = $this->repository->paginate($perPage, [
                'phone_number',
                'name',
                'status',
                'created_at'
            ]);
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.list_fail'));
        }

        return $this->responseSuccess('', $customers);
    }
}
