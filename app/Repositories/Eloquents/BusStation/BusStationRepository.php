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
     * List bus station
     *
     * @param int $type Type of select bus station
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listBusStation(int $type)
    {
        if ($type === BusStation::TYPE_CITY) {
            return $this->scopeQuery(function ($query) use ($type) {
                return $query->where('parent_id', DB::raw('id'));
            })->orderBy('city', 'asc')
            ->all([
                'id',
                'city'
            ]);
        }

        return $this->orderBy('city', 'asc')->all([
            'id',
            'city',
            'name_station'
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
        $with['childBusStation'] = function ($query) use ($id) {
            return $query->select([
                'id',
                'parent_id',
                'name_station'
            ]);
        };

        return $this->with($with)->find($id, [
            'id',
            'city',
        ]);
    }
}
