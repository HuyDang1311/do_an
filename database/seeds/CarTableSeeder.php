<?php

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
        $faker = \Faker\Factory::create('en_US');
        $now = \Carbon\Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'car_number_plates' => $faker->buildingNumber,
                'car_manufacturer' => $faker->streetName,
                'seat_quantity' => 50,
                'company_id' => rand(1, 50),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        \App\Models\Car::insert($data);
    }
}
