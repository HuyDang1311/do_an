<?php

namespace App\Repositories\Interfaces\Driver;

interface DriverRepositoryInterface
{

    /**
     * List driver
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listDriver(array $data);

    /**
     * Show driver
     *
     * @param int $id Id of driver
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showDriver(int $id);

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
    public function updateCar(int $id, array $data);

    /**
     * Create driver
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createDriver(array $data);
}
