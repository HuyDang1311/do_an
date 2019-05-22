<?php

namespace App\Repositories\Interfaces\BusStation;

interface BusStationRepositoryInterface
{

    /**
     * List bus station
     *
     * @param int $type Type of select bus station
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listBusStation(int $type);

    /**
     * List bus station
     *
     * @param int $id Id of bus station
     *
     * @return mixed
     */
    public function showBusStation(int $id);
}
