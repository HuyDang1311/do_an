<?php

namespace App\Repositories\Interfaces\BusStation;

interface BusStationRepositoryInterface
{

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
    public function listBusStation(int $type, array $data = []);

    /**
     * List bus station
     *
     * @param int $id Id of bus station
     *
     * @return mixed
     */
    public function showBusStation(int $id);
}
