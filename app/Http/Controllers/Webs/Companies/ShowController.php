<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class ShowController extends Controller
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
     * Show company
     *
     * @param Request $request Request
     * @param int     $id      Id of company
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $company = $this->repository->showCompany($id);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.companies.show_fail'));
            return redirect('companies/index')
                ->with(['error' => trans('message.companies.show_fail')]);
        }

        return view('web.companies.show')->with([
            'data' => $company
        ]);
    }
}
