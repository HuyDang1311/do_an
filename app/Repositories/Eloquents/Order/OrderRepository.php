<?php
namespace App\Repositories\Eloquents\Order;

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
        $customerId = Auth::user()->id;

        $result = $this->with($this->withOrderDetail())
            ->scopeQuery(function ($query) use ($customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->find($id, $this->getColumns());

        return $result;
    }

    /**
     * History order
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function historyOrder()
    {
        $customerId = Auth::user()->id;

        $result = $this->with($this->withOrderDetail())
            ->scopeQuery(function ($query) use ($customerId) {
                return $query->where('customer_id', $customerId);
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
            'id',
            'plan_id',
            'customer_id',
            'order_code',
            'payment_method_id',
            DB::raw("CASE WHEN payment_method_id = " . Order::PAYMENT_METHOD_DIRECT_MONEY
                . " THEN '" . trans(Order::$paymentMethodObject[Order::PAYMENT_METHOD_DIRECT_MONEY])
                . "' ELSE '' END as payment_method_name"),
            'coupon_id',
            'status',
            DB::raw("CASE WHEN payment_method_id = " . Order::STATUS_REGISTERED
                . " THEN '" . trans(Order::$statusObject[Order::STATUS_REGISTERED])
                . "' WHEN payment_method_id = " . Order::STATUS_RUNNING
                . " THEN '" . trans(Order::$statusObject[Order::STATUS_RUNNING])
                . "' WHEN payment_method_id = " . Order::STATUS_DONE
                . " THEN '" . trans(Order::$statusObject[Order::STATUS_DONE])
                . "' ELSE '" . trans(Order::$statusObject[Order::STATUS_CANCEL]) . "' END as status_name"),
            'seat_ids',
            'created_at'
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
        $data['customer_id'] = Auth::user()->id;
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
