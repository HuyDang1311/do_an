<?php
namespace App\Repositories\Interfaces\Order;

use App\Models\Order;

interface OrderRepositoryInterface
{

    /**
     * List order
     *
     * @param array $data Data
     *
     * @return array
     */
    public function listOrders(array $data);

    /**
     * Create order
     *
     * @param array $data Data to create order
     *
     * @return array
     */
    public function createOrder(array $data);

    /**
     * Show order
     *
     * @param int $id Id of order
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function showOrder(int $id);

    /**
     * History order
     *
     * @param int $customerId Id of customer
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function historyOrder($customerId);

    /**
     * Cancel order
     *
     * @param int $id Id of order
     *
     * @return array
     *
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function cancelOrder(int $id, int $status = Order::STATUS_DONE);
}
