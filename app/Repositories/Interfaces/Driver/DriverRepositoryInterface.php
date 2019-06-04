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
     * Update driver
     *
     * @param int   $id   Id of driver
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateDriver(int $id, array $data);

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
