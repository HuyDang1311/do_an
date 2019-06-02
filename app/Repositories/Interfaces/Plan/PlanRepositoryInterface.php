<?php
namespace App\Repositories\Interfaces\Plan;

interface PlanRepositoryInterface
{
    /**
     * List plan
     *
     * @param array $searchData Search data
     * @param array $sortData   Sort data
     * @param array $params     Parameter
     *
     * @return array
     */
    public function listPlan(array $searchData, array $sortData, array $params = []);

    /**
     * Show plan
     *
     * @param int $id Id of plan
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showPlan(int $id);

    /**
     * Get query for get plan
     *
     * @return $this
     */
    public function queryGetPlan();

    /**
     * List plan of driver
     *
     * @param int $driverId Driver id
     * @param int $type Type of get plan
     * @param array $params Parameter
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function listDriverPlan(int $driverId, int $type, array $params = []);

    /**
     * List plan of driver
     *
     * @param int $driverId Driver id
     * @param int $planId   Plan id
     * @param array $params Parameter
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showPlanOfDriver(int $driverId, int $planId, array $params = []);
}
