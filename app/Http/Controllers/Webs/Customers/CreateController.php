<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\ApiController;
use App\Repositories\Exceptions\ValidatorException;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Validators\Customer\CreateCustomerValidator;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends ApiController
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
     * Handle the incoming request.
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
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
            $this->validator->validateData($data);
            $customer = $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return $this->responseError(
                trans('message.validate.fail'),
                $ex->toArray(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        } catch (Exception $ex) {
            return $this->responseError(trans('message.customer.create_fail'));
        }

        return $this->responseSuccess(
            trans('message.customer.create_success'),
            ['id' => $customer->id],
            Response::HTTP_CREATED
        );
    }
}
