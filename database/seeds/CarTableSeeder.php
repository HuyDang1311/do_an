<?php

use App\Models\Car;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
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
                'car_number_plates' => $faker->name,
                'car_manufacturer' => $faker->streetName,
                'seat_quantity' => 50,
                'type' => rand(1,2),
                'company_id' => rand(1, 50),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        Car::insert($data);
    }
}
