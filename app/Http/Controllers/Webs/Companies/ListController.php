<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * CompanyRepositoryInterface
     *
     * @var CompanyRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CompanyRepositoryInterface $repository CompanyRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CompanyRepositoryInterface $repository
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
                'name',
                'address',
                'phone_number',
                'email',
            ]);

            $companies = $this->repository->listCompany($data);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.companies.list_fail'));
            return back()->withInput($data);
        }

        return view('web.companies.index')->with([
            'input' => $data,
            'data' => $companies
        ]);
    }
}
