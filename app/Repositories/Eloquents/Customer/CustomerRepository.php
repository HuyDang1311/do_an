<?php

namespace App\Repositories\Eloquents\Customer;

use App\Models\Customer;
use App\Models\User;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use DB;

class CustomerRepository extends AbstractRepository implements CustomerRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'phone_number' => ['column' => 'customers.phone_number', 'operator' => 'ilike', 'type' => 'normal'],
        'address' => ['column' => 'customers.address', 'operator' => 'ilike', 'type' => 'normal'],
        'name' => ['column' => 'customers.name', 'operator' => 'ilike', 'type' => 'normal'],
        'email' => ['column' => 'customers.email', 'operator' => 'ilike', 'type' => 'normal'],
    ];

    /**
     * List Customer
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCustomer(array $data)
    {
        return $this->search($data)
            ->orderBy('name', 'asc')->all([
                'id',
                'name',
                'email',
                'address',
                'phone_number',
                'status',
                'created_at',
                DB::raw("CASE WHEN status = " . Customer::STATUS_USING
                    . " THEN '" . trans('label.customers.using')
                    . "' WHEN status = " . User::STATUS_STOP
                    . " THEN '" . trans('label.customers.stop')
                    . "' END as status_name"),
                DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
            ]);
    }

    /**
     * Show Customer
     *
     * @param int $id Id of Customer
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCustomer(int $id)
    {
        Customer::$ignoreMutator = false;
        return $this->find($id, [
            'id',
            'name',
            'email',
            'address',
            'phone_number',
            'status',
            'created_at',
            DB::raw("CASE WHEN status = " . Customer::STATUS_USING
                . " THEN '" . trans('label.customers.using')
                . "' WHEN status = " . User::STATUS_STOP
                . " THEN '" . trans('label.customers.stop')
                . "' END as status_name"),
            DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
        ]);
    }

    /**
     * Update Customer
     *
     * @param int   $id   Id of Customer
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCustomer(int $id, array $data)
    {
        if (!$data['password']) {
            unset($data['password']);
        }
        return $this->update($data, $id);
    }

    /**
     * Create Customer
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCustomer(array $data)
    {
        return $this->create($data);
    }
}
