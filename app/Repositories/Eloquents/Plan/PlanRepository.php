<?php
namespace App\Repositories\Eloquents\Plan;

use App\Models\Plan;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;

class PlanRepository extends AbstractRepository implements PlanRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Plan::class;
    }
    /**
     * Field seachable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'address_start_id' => ['column' => 'plans.address_start_id', 'operator' => '=', 'type' => 'normal'],
        'address_end_id' => ['column' => 'plans.address_end_id', 'operator' => '=', 'type' => 'normal'],
        'time_start' => ['column' => 'plans.time_start', 'operator' => '=', 'type' => 'date'],
    ];
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
    public function listPlan(array $searchData, array $sortData, array $params = [],array $columns = ['*'])
    {
        return $this->search($searchData)
            ->orderBy($sortData['sort_column'], $sortData['sort_direction'])
            ->paginate($params['per_page'] ?? 10, $columns);
    }
}
