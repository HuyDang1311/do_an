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
    public function listCompany(array $data)
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
            DB::raw("ROW_NUMBER () OVER (ORDER BY name) as row_number")
        ]);
    }

    /**
     * List bus station
     *
     * @param int $id Id of bus station
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showBusStation(int $id)
    {
        $with['childBusStation'] = function ($query) {
            return $query->select([
                'id',
                'parent_id',
                'name_station'
            ]);
        };

        return $this->with($with)->find($id, [
            'id',
            'city',
            'name_station',
            'created_at',
            'latitude',
            'longitude',
        ]);
    }

    /**
     * Update bus station
     *
     * @param int   $id Id of bus station
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateBusStation(int $id, array $data)
    {
        $busStations = $this->update($data, $id);

        $parent = BusStation::whereNull('deleted_at')
            ->where(DB::raw('lower(city)'), '=', strtolower($busStations->city))
            ->first(['id']);

        $busStations->parent_id = $parent->id ?? $busStations->id;
        $busStations->save();

        return $busStations;
    }

    /**
     * Create bus station
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createBusStation(array $data)
    {
        $busStations = $this->create($data);

        $parent = BusStation::whereNull('deleted_at')
            ->where(DB::raw('lower(city)'), '=', strtolower($busStations->city))
            ->first(['id']);

        $busStations->parent_id = $parent->id ?? $busStations->id;
        $busStations->save();

        return $busStations;
    }
}
