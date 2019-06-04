<?php

namespace App\Repositories\Interfaces\Car;

interface CarRepositoryInterface
{

    /**
     * List car
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCar(array $data);

    /**
     * Show car
     *
     * @param int $id Id of car
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCar(int $id);

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
     * Create car
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCar(array $data);
}
