<?php
namespace App\Repositories\Eloquents\Plan;

use App\Models\Car;
use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
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
            ->all($this->getColumnsForList());

        $results = $results->toArray();

        $this->updateDataResult($results);

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
            ->find($id, $this->getColumnsForList());

        return $this->updateDataRecord($results->toArray());
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
    public function listDriverPlan(int $driverId, int $type, array $params = [])
    {
        User::findOrFail($driverId);

        $results = $this->scopeQuery(function ($query) use ($driverId, $type) {
            $query->join('bus_stations as bus_start', 'bus_start.id', '=', 'plans.address_start_id')
                ->join('bus_stations as bus_end', 'bus_end.id', '=', 'plans.address_end_id')
                ->join('companies', 'companies.id', '=', 'plans.company_id')
                ->join('cars', 'cars.id', '=', 'plans.car_id')
                ->leftJoin(
                    DB::raw('(SELECT array_to_json(array_agg(seat_id)) as seat_ids, plan_id FROM (SELECT unnest(od.seat_ids), od.plan_id FROM orders as od GROUP BY od.seat_ids, od.plan_id) as dt(seat_id, plan_id) GROUP BY dt.plan_id) as os'),
                    'os.plan_id',
                    '=',
                    'plans.id'
                )
                ->where('user_driver_id', '=', $driverId);
                $now = Carbon::now()->toDate();
                switch ($type) {
                    case Plan::TYPE_HISTORY_PLAN;
                        return $query->whereDate('time_start', '<', $now);
                    case Plan::TYPE_NOW_DAY_PLAN;
                        return $query->whereDate('time_start', '=', $now);
                    case Plan::TYPE_FUTURE_PLAN;
                        return $query->whereDate('time_start', '>', $now);
                }
        })
            ->orderBy('time_start', 'desc')
            ->all($this->getColumnsForList());

        $results = $results->toArray();

        $this->updateDataResult($results);

        return $results;
    }

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
    public function showPlanOfDriver(int $driverId, int $planId, array $params = [])
    {
        $with['order'] = function ($query) {
            return $query->join('plans', 'orders.plan_id', '=', 'plans.id')
                ->join('companies', 'plans.company_id', '=', 'companies.id')->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
                ->join('bus_stations as bt1', 'bt1.id', '=', 'order_detail.address_start_id')
                ->join('bus_stations as bt2', 'bt2.id', '=', 'order_detail.address_end_id')
                ->select([
                'orders.id',
                'orders.plan_id',
                'orders.customer_id',
                'orders.order_code',
                'orders.payment_method_id',
                DB::raw("CASE WHEN orders.payment_method_id = " . Order::PAYMENT_METHOD_DIRECT_MONEY
                    . " THEN '" . trans(Order::$paymentMethodObject[Order::PAYMENT_METHOD_DIRECT_MONEY])
                    . "' ELSE '' END as payment_method_name"),
                'orders.coupon_id',
                'orders.status',
                DB::raw("CASE WHEN orders.status = " . Order::STATUS_REGISTERED
                    . " THEN '" . trans(Order::$statusObject[Order::STATUS_REGISTERED])
                    . "' WHEN orders.status = " . Order::STATUS_RUNNING
                    . " THEN '" . trans(Order::$statusObject[Order::STATUS_RUNNING])
                    . "' WHEN orders.status = " . Order::STATUS_DONE
                    . " THEN '" . trans(Order::$statusObject[Order::STATUS_DONE])
                    . "' ELSE '" . trans(Order::$statusObject[Order::STATUS_CANCEL])
                    . "' END as status_name"),
                'orders.seat_ids',
                'orders.created_at',
                'order_detail.address_start_id',
                'bt1.city as address_start_city',
                'bt1.name_station as address_start_name_station',
                'order_detail.address_end_id',
                'bt2.city as address_end_city',
                'bt2.name_station as address_end_name_station',
                'companies.name as company_name',
                DB::raw('DATE(plans.time_start) as date_start'),
                DB::raw('DATE(plans.time_end) as date_end'),
                DB::raw("to_char(plans.time_start,'HH24:MI') as time_start"),
                DB::raw("to_char(plans.time_end,'HH24:MI') as time_end")
            ]);
        };
        User::findOrFail($driverId);

        $results = $this->with($with)
            ->queryGetPlan()
            ->find($planId, $this->getColumnsForList());

        return $this->updateDataRecord($results->toArray());
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
            "bus_start.name_station as address_start_bus_station",
            "plans.address_end_id",
            "bus_end.city as address_end_city",
            "bus_start.name_station as address_end_bus_station",
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
