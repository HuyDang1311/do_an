<?php

use Illuminate\Database\Seeder;

class SeatTableSeeder extends Seeder
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
                'name' => $faker->name,
                'type' => rand(\App\Models\Seat::TYPE_1, \App\Models\Seat::TYPE_2),
                'status' => \App\Models\Seat::STATUS_USING,
                'car_id' => rand(1, 50),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Seat::insert($data);
    }
}
