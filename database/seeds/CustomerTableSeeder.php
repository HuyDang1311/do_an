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
        $password = bcrypt('1234567');
        $now = \Carbon\Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'password' => $password,
                'name' => $faker->name,
                'status' => \App\Models\Customer::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Customer::insert($data);
    }
}
