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
     * @param array $columns    Columns
     *
     * @return array
     */
    public function listPlan(array $searchData, array $sortData, array $params = [],array $columns = ['*']);
}
