<?php

use Illuminate\Database\Seeder;

class BusStationTableSeeder extends Seeder
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
                'city' => $faker->city,
                'name_station' => $faker->citySuffix,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\BusStation::insert($data);
    }
}
