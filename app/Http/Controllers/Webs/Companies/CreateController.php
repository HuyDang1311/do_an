<?php

namespace App\Http\Controllers\Webs\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
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
            $this->beginTransaction();
            $data = $request->only([
                'name',
                'address',
                'phone_number',
                'email',
                'status',
            ]);
            $data['status'] = $data['status'] ?? Company::STATUS_USING;

            $company = $this->repository->createCompany($data);

            $adminData = [
                'name' => $request->get('admin_name'),
                'email' => $request->get('admin_email'),
                'username' => $request->get('admin_username'),
                'password' => $request->get('admin_password'),
                'address' => $request->get('admin_address'),
                'phone_number' => $request->get('admin_phone_number'),
            ];
            $adminData['status'] = User::STATUS_USING;
            $adminData['company_id'] = $company->id;
            $adminData['role'] = User::ROLE_ADMIN;
            $adminData['password'] = bcrypt($adminData['password']);

            User::insert($adminData);

            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            session()->flash('error', trans('message.companies.create_fail'));
            return back()->withInput($data);
        }

        session()->flash('message_success', trans('message.companies.create_success'));
        return redirect('companies/show/' . $company->id);
    }
}
