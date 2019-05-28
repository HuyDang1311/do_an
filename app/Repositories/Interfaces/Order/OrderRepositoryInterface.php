<?php
namespace App\Repositories\Interfaces\Order;

interface OrderRepositoryInterface
{

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
}
