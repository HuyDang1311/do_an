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
     * Show company
     *
     * @param int $id Id of company
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCompany(int $id);

    /**
     * Update company
     *
     * @param int $id Id of company
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCompany(int $id, array $data);

    /**
     * Create company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCompany(array $data);
}
