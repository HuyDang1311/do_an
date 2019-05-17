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
     */
    public function showOrder(int $id);
}
