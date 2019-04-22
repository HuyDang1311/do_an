<?php

use App\Models\Seat;
use Carbon\Carbon;
use Faker\Factory;
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
        $faker = Factory::create('en_US');
        $now = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'name' => $faker->name,
//                'type' => rand(Seat::TYPE_1, Seat::TYPE_2),
                'status' => Seat::STATUS_USING,
                'car_id' => rand(1, 50),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Seat::insert($data);
    }
}
