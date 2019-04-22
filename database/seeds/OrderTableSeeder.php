<?php

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $now = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'plan_id' => $i,
                'customer_id' => $i,
                'status' => Order::STATUS_USING,
                'order_code' => $i . '_code',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Order::insert($data);
    }
}
