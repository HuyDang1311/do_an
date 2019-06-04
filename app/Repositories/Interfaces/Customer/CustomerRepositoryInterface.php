<?php

namespace App\Repositories\Interfaces\Customer;

interface CustomerRepositoryInterface
{

    /**
     * List customer
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCustomer(array $data);

    /**
     * Show customer
     *
     * @param int $id Id of customer
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showCustomer(int $id);

    /**
     * Update car
     *
     * @param int $id Id of customer
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function updateCustomer(int $id, array $data);

    /**
     * Create customer
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createCustomer(array $data);
}
