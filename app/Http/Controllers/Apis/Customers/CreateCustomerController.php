<?php

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Validators\Customer\CreateCustomerValidator;
use Illuminate\Http\Request;
use Exception;

class CreateCustomerController extends ApiController
{

    /**
     * CustomerRepositoryInterface
     *
     * @var CustomerRepositoryInterface
     */
    protected $repository;

    /**
     * CreateCustomerValidator
     *
     * @var CreateCustomerValidator
     */
    protected $validator;

    /**
     * Constructor.
     *
     * @param CustomerRepositoryInterface $repository CustomerRepositoryInterface
     * @param CreateCustomerValidator     $validator  CreateCustomerValidator
     *
     * @return void
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        CreateCustomerValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * List announcements
     *
     * @param Request $request Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {
        $data = $request->only([
            'phone_number',
            'password',
            'name',
        ]);

        try {
            $announcements = $this->announcement->listAnnouncements($params);
        } catch (Exception $ex) {
            return $this->responseError(trans('messages.customer.create_success'));
        }

        return $this->responseSuccess(trans('messages.customer.create_success'));
    }
}
