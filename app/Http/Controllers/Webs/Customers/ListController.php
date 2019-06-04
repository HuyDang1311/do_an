<?php

namespace App\Http\Controllers\Webs\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
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
     * List bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $data = $request->only([
                'phone_number',
                'address',
                'name',
                'email',
            ]);

            $customers = $this->repository->listCustomer($data);
        } catch (Exception $ex) {
            return back()->with(trans('message.customers.list_fail'));
        }

        return view('web.customers.index')->with([
            'input' => $data,
            'data' => $customers,
        ]);
    }
}
