<?php

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
        $now = \Carbon\Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'seat_id' => $i,
                'plan_id' => $i,
                'customer_id' => $i,
                'status' => \App\Models\Order::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Order::insert($data);
    }
}
