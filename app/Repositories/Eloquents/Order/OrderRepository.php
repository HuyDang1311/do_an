<?php
namespace App\Repositories\Eloquents\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Eloquents\AbstractRepository;
use App\Repositories\Interfaces\Order\OrderRepositoryInterface;

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
        $with['orderDetail'] = function ($query) {
            return $query->select([
                'order_id',
                'quantity',
                'total_money',
                'payment_status',
                'process_status',
            ]);
        };

        return $this->with($with)->find($id, [
            'id',
            'plan_id',
            'customer_id',
            'order_code',
            'payment_method_id',
            'coupon_id',
            'status',
            'seat_ids',
            'created_at'
        ]);
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
        $data['customer_id'] = 1;
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
