<?php
namespace App\Repositories\Eloquents\Order;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Create order
     *
     * @param array $data Data to create order
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function createOrder(array $data)
    {
        //validate customer id
        Customer::findOrFail($data['customer_id'] ?? 0);

        $data = $this->updateDataToCreate($data);

        $order = $this->create($data);

        $order->orderDetail()->create($this->updateOrderDetailData($order, $data));

        return $order->makeHidden(['plan']);
    }

    /**
     * Show order
     *
     * @param int $id Id of order
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showOrder(int $id)
    {
        $result = $this->with($this->withOrderDetail())
            ->scopeQuery(function ($query) {
                return $query->join('plans', 'orders.plan_id', '=', 'plans.id')
                    ->join('companies', 'plans.company_id', '=', 'companies.id')->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
                    ->join('bus_stations as bt1', 'bt1.id', '=', 'order_detail.address_start_id')
                    ->join('bus_stations as bt2', 'bt2.id', '=', 'order_detail.address_end_id');
            })
            ->find($id, $this->getColumns());

        return $result;
    }

    /**
     * History order
     *
     * @param int $customerId Id of customer
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function historyOrder($customerId)
    {
        //validate customer id
        Customer::findOrFail($customerId ?? 0);

        $result = $this->with($this->withOrderDetail())
            ->scopeQuery(function ($query) use ($customerId) {
                return $query->join('plans', 'orders.plan_id', '=', 'plans.id')
                    ->join('companies', 'plans.company_id', '=', 'companies.id')
                    ->join('order_detail', 'order_detail.order_id', '=', 'orders.id')
                    ->join('bus_stations as bt1', 'bt1.id', '=', 'order_detail.address_start_id')
                    ->join('bus_stations as bt2', 'bt2.id', '=', 'order_detail.address_end_id')
                    ->where('customer_id', $customerId);
            })
            ->all($this->getColumns());

        return $result;
    }

    /**
     * Get with order detail
     *
     * @return array
     */
    private function withOrderDetail()
    {
        $with['orderDetail'] = function ($query) {
            return $query->select([
                'order_id',
                'quantity',
                'total_money',
                'payment_status',
                'process_status',
            ]);
        };

        return $with;
    }

    /**
     * Get column select order
     *
     * @return array
     */
    private function getColumns()
    {
        return [
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
            DB::raw("to_char(plans.time_start,'HH:MM') as time_start"),
            DB::raw("to_char(plans.time_end,'HH:MM') as time_end"),
        ];
    }

    /**
     * Update data before create order
     *
     * @param array $data Data to create order
     *
     * @return array
     */
    private function updateDataToCreate(array $data)
    {
        $data['arr_seat_ids'] = is_array($data['seat_ids']) ? $data['seat_ids'] : explode(',', $data['seat_ids']);
        $data['seat_ids'] = toPgArray($data['seat_ids']);
        $data['payment_method_id'] = $data['payment_method_id'] ?? Order::PAYMENT_METHOD_DIRECT_MONEY;
        return $data;
    }

    /**
     * Update data before create order detail
     *
     * @param Order $order Order data
     * @param array $data  Data
     *
     * @return array
     */
    private function updateOrderDetailData($order, array $data)
    {
        $data['quantity'] = count($data['arr_seat_ids'] ?? []);
        $data['total_money'] = intval($order->plan->price_ticket ?? 0) * $data['quantity'];
        $data['payment_status'] = OrderDetail::PAYMENT_STATUS_NOT_PAYED;
        $data['process_status'] = OrderDetail::PROCESS_STATUS_USING;
        return $data;
    }
}
