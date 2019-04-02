<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $dateStart = \Carbon\Carbon::now()->subDay(rand(1, 50));
            $dateEnd = $dateStart->copy()->addHour(5);
            $now = \Carbon\Carbon::now();

            $data[] = [
                'address_start_id' => rand(1, 50),
                'address_end_id' => rand(1, 50),
                'time_start' => $dateStart,
                'time_end' => $dateEnd,
                'car_id' => rand(1, 50),
                'company_id' => rand(1, 50),
                'status' => \App\Models\Plan::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Plan::insert($data);
    }
}
