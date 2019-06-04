<?php

namespace App\Repositories\Eloquents\Company;

use App\Models\BusStation;
use App\Models\Company;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Company\CompanyRepositoryInterface;
use DB;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name' => ['column' => 'companies.name', 'operator' => 'ilike', 'type' => 'normal'],
        'address' => ['column' => 'companies.address', 'operator' => 'ilike', 'type' => 'normal'],
        'phone_number' => ['column' => 'companies.phone_number', 'operator' => 'ilike', 'type' => 'normal'],
        'email' => ['column' => 'companies.email', 'operator' => 'ilike', 'type' => 'normal'],
    ];

    /**
     * List company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCompany(array $data = [])
    {
        $query = $this->search($data);

        return $query->orderBy('name', 'asc')->all([
            'id',
            'name',
            'address',
            'phone_number',
            'email',
            'status',
            'created_at',
            DB::raw("CASE WHEN status = " . Company::STATUS_USING
                . " THEN '" . trans('label.companies.status_using')
                . "' WHEN status = " . Company::STATUS_STOP
                . " THEN '" . trans('label.companies.status_stop')
                . "' END as status_name"),
            DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
        ]);
    }

    /**
     * Show company
     *
     * @param int $id Id of company
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCompany(int $id)
    {
        return $this->find($id, [
            'id',
            'name',
            'address',
            'phone_number',
            'email',
            'status',
            'created_at',
            DB::raw("CASE WHEN status = " . Company::STATUS_USING
                . " THEN '" . trans('label.companies.status_using')
                . "' WHEN status = " . Company::STATUS_STOP
                . " THEN '" . trans('label.companies.status_stop')
                . "' END as status_name"),
        ]);
    }

    /**
     * Update company
     *
     * @param int $id Id of company
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCompany(int $id, array $data)
    {
        return $this->update($data, $id);
    }

    /**
     * Create company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCompany(array $data)
    {
        return $this->create($data);
    }
}
