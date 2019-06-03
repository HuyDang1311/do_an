<?php

namespace App\Repositories\Interfaces\Company;

interface CompanyRepositoryInterface
{

    /**
     * List company
     *
     * @param array $data Data
     *
     * @return mixed
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listCompany(array $data);

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
