<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
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

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'password' => bcrypt('1234567'),
                'name' => $faker->name,
                'status' => \App\Models\Customer::STATUS_USING,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];
        }

        \App\Models\Customer::insert($data);
    }
}
