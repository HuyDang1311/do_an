<?php

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Exceptions\ValidatorException;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Validators\Customer\CreateCustomerValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\HttpFoundation\Response;

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
     * @return JsonResponse
     */
    public function handle(Request $request)
    {
        $data = $request->only([
            'phone_number',
            'password',
            'name',
        ]);

        try {
            $this->validator->validateData($data);
            $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return $this->responseError(
                trans('message.validate.fail'),
                $ex->toArray(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.create_fail'));
        }

        return $this->responseSuccess(trans('message.customer.create_success'));
    }
}
