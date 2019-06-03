<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * BusStationRepositoryInterface
     *
     * @var CompanyRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CompanyRepositoryInterface $repository BusStationRepositoryInterface
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
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        return view('web.companies.create')
            ->with(['status_object' => transArr(Company::$statusObject)]);
    }

    /**
     * Create bus stations
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $data = $request->only([
                'name',
                'address',
                'phone_number',
                'email',
                'status',
            ]);
            $data['status'] = $data['status'] ?? Company::STATUS_USING;
            $busStation = $this->repository->createCompany($data);
        } catch (Exception $ex) {
            return back()->with(['error' => trans('message.companies.create_fail')]);
        }

        return redirect('companies/show/' . $busStation->id);
    }
}
