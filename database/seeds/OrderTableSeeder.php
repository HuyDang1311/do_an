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
        $planIds = \App\Models\Plan::all(['id'])->pluck('id')->toArray();
        $data = [];
        $now = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'plan_id' => rand(45, 50),
                'customer_id' => $i,
                'status' => Order::STATUS_USING,
                'order_code' => $i . '_code',
                'seat_ids' => toPgArray(['A-0','B-5','B-10']),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Order::insert($data);
    }
}
