<?php

use App\Models\BusStation;
use Carbon\Carbon;
use Faker\Factory;
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
        $faker = Factory::create('en_US');
        $now = Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'city' => $faker->city,
                'name_station' => $faker->citySuffix,
                'parent_id' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        BusStation::insert($data);
    }
}
