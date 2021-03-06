<?php

namespace App\Repositories\Eloquents\BusStation;

use App\Models\BusStation;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;
use DB;

class BusStationRepository extends AbstractRepository implements BusStationRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusStation::class;
    }

    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'city_name' => ['column' => 'bus_stations.city', 'operator' => 'ilike', 'type' => 'normal'],
        'station_name' => ['column' => 'bus_stations.name_station', 'operator' => 'ilike', 'type' => 'normal'],
    ];

    /**
     * List bus station
     *
     * @param int   $type Type of select bus station
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listBusStation(int $type, array $data = [])
    {
        $query = $this->search($data);

        if ($type === BusStation::TYPE_CITY) {
            return $query->scopeQuery(function ($query) {
                return $query->where('parent_id', DB::raw('id'));
            })->orderBy('city', 'asc')
            ->groupBy(['id', 'city'])
            ->all([
                'id',
                'city',
            ]);
        }

        return $query->orderBy('city', 'asc')->all([
            'id',
            'city',
            'name_station',
            'created_at',
            'latitude',
            'longitude',
            DB::raw("ROW_NUMBER () OVER (ORDER BY city) as row_number")
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
