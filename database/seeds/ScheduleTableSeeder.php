<?php

use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create('en_US');
        $now = \Carbon\Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'user_id' => $i,
                'plan_id' => $i,
                'car_id' => $i,
                'status' => \App\Models\Schedule::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Schedule::insert($data);
    }
}
