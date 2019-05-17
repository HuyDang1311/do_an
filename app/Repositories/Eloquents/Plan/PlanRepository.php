<?php
namespace App\Repositories\Eloquents\Plan;

use App\Models\Car;
use App\Models\Plan;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Plan\PlanRepositoryInterface;
use Carbon\Carbon;
use DB;

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
     *
     * @return array
     */
    public function listPlan(array $searchData, array $sortData, array $params = [])
    {
        $results = $this->queryGetPlan()
            ->search($searchData)
            ->orderBy($sortData['sort_column'], $sortData['sort_direction'])
            ->paginate($params['per_page'] ?? 10, $this->getColumnsForList());

        $this->updateDataResult($results['items']);

        return $results;
    }

    /**
     * Show plan
     *
     * @param int $id Id of plan
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showPlan(int $id)
    {
        $results = $this->queryGetPlan()
            ->find($id, $this->getColumnsForList())
            ->toArray();

        return $this->updateDataRecord($results);
    }

    /**
     * Get query for get plan
     *
     * @return $this
     */
    public function queryGetPlan()
    {
        return $this->scopeQuery(function ($query) {
            return $query->join('bus_stations as bus_start', 'bus_start.id', '=', 'plans.address_start_id')
                ->join('bus_stations as bus_end', 'bus_end.id', '=', 'plans.address_end_id')
                ->join('companies', 'companies.id', '=', 'plans.company_id')
                ->join('cars', 'cars.id', '=', 'plans.car_id')
                ->leftJoin(
                    DB::raw('(SELECT array_to_json(array_agg(seat_id)) as seat_ids, plan_id FROM (SELECT unnest(od.seat_ids), od.plan_id FROM orders as od GROUP BY od.seat_ids, od.plan_id) as dt(seat_id, plan_id) GROUP BY dt.plan_id) as os'),
                    'os.plan_id',
                    '=',
                    'plans.id'
                );
        });
    }

    /**
     * Get columns
     *
     * @return array
     */
    private function getColumnsForList()
    {
        return [
            "plans.id",
            "plans.address_start_id",
            "bus_start.city as address_start_city",
            "plans.address_end_id",
            "bus_end.city as address_end_city",
            "plans.time_start",
            "plans.time_end",
            "plans.car_id",
            'cars.seat_quantity',
            'cars.type as car_type',
            "plans.user_driver_id",
            "plans.company_id",
            "companies.name as company_name",
            "plans.status",
            "plans.price_ticket",
            'os.seat_ids as seat_ids'
        ];
    }

    /**
     * Update record data
     *
     * @param array $value Data
     *
     * @return array
     */
    private function updateDataRecord(array $value)
    {
        $value['day_start'] = Carbon::parse($value['time_start'])->toDateString();
        $timeStart = Carbon::parse($value['time_start']);
        $timeEnd = Carbon::parse($value['time_end']);
        $value['time_between'] = $timeStart->diff($timeEnd)->format('%Hh%Ip');
        $value['time_start'] = $timeStart->format('H:i');
        $value['time_end'] = $timeEnd->format('H:i');
        $value['status_name'] = trans(Plan::$status[$value['status']] ?? '');
        $value['car_type_name'] = trans(Car::$type[$value['car_type']] ?? '');
        $value['seat_quantity_empty'] = max(
            intval($value['seat_quantity']) - count(json_decode($value['seat_ids']) ?? []),
            0
        );

        return $value;
    }

    /**
     * Update result data
     *
     * @param array $data Data
     *
     * @return void
     */
    private function updateDataResult(array &$data)
    {
        array_walk($data, function (&$value) {
            $value = $this->updateDataRecord($value);
        });
    }
}
