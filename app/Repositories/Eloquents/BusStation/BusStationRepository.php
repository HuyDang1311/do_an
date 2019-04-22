<?php

namespace App\Repositories\Eloquents\BusStation;

use App\Models\BusStation;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\BusStation\BusStationRepositoryInterface;

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
}
