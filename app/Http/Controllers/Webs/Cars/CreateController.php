<?php

namespace App\Http\Controllers\Webs\Cars;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\Interfaces\Car\CarRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * CarRepositoryInterface
     *
     * @var CarRepositoryInterface
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param CarRepositoryInterface $repository CarRepositoryInterface
     *
     * @return void
     */
    public function __construct(
        CarRepositoryInterface $repository
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
