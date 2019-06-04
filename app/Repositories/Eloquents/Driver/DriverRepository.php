<?php

namespace App\Repositories\Eloquents\Driver;

use App\Models\Car;
use App\Models\User;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Driver\DriverRepositoryInterface;
use DB;

class DriverRepository extends AbstractRepository implements DriverRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'name' => ['column' => 'users.name', 'operator' => 'ilike', 'type' => 'normal'],
        'email' => ['column' => 'users.email', 'operator' => 'ilike', 'type' => 'normal'],
        'address' => ['column' => 'users.address', 'operator' => '=', 'type' => 'normal'],
        'company_id' => ['column' => 'users.company_id', 'operator' => '=', 'type' => 'normal'],
    ];

    /**
     * List driver
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listDriver(array $data)
    {
        $with['company'] = function ($query) {
            return $query->select([
                'id',
                'name',
            ]);
        };

        return $this->with($with)->search($data)
            ->scopeQuery(function ($query) {
                return $query->where('role', '=', User::ROLE_MANAGER);
            })
            ->orderBy('name', 'asc')->all([
                'id',
                'name',
                'email',
                'username',
                'address',
                'phone_number',
                'company_id',
                'status',
                'created_at',
                DB::raw("CASE WHEN status = " . User::STATUS_USING
                    . " THEN '" . trans('label.drivers.using')
                    . "' WHEN status = " . User::STATUS_STOP
                    . " THEN '" . trans('label.drivers.stop')
                    . "' END as status_name"),
                DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
            ]);
    }

    /**
     * Show driver
     *
     * @param int $id Id of driver
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showDriver(int $id)
    {
        $with['company'] = function ($query) {
            return $query->select([
                'id',
                'name',
            ]);
        };

        return $this->with($with)
            ->scopeQuery(function ($query) {
                return $query->where('role', '=', User::ROLE_MANAGER);
            })
            ->find($id, [
                'id',
                'name',
                'email',
                'username',
                'address',
                'phone_number',
                'company_id',
                'status',
                'created_at',
                DB::raw("CASE WHEN status = " . User::STATUS_USING
                    . " THEN '" . trans('label.drivers.using')
                    . "' WHEN status = " . User::STATUS_STOP
                    . " THEN '" . trans('label.drivers.stop')
                    . "' END as status_name"),
                DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
            ]);
    }

    /**
     * Update car
     *
     * @param int $id Id of car
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCar(int $id, array $data)
    {
        if (!$data['password']) {
            unset($data['password']);
        }
        return $this->update($data, $id);
    }

    /**
     * Create driver
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createDriver(array $data)
    {
        $data['status'] = User::STATUS_USING;
        $data['role'] = User::ROLE_MANAGER;
        return $this->create($data);
    }
}
