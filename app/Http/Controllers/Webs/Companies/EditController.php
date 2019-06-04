<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class EditController extends Controller
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
     * Show form update bus stations
     *
     * @param Request $request Request
     * @param int     $id      Id of bus station
     *
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $company = $this->repository->showCompany($id);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.companies.show_fail')]);
        }

        return view('web.companies.edit')->with([
            'data' => $company,
            'status_object' => transArr(Company::$statusObject)
        ]);
    }

    /**
     * Update company
     *
     * @param Request $request Request
     * @param int     $id      Id of company
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->only([
                'name',
                'address',
                'phone_number',
                'email',
                'status',
            ]);
            $company = $this->repository->updateCompany($id, $data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.companies.update_fail')]);
        }

        return redirect('companies/show/' . $company->id);
    }
}
