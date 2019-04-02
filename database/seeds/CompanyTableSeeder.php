<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
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
                'address' => $faker->address,
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'email' => $faker->email,
                'status' => \App\Models\Customer::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Company::insert($data);
    }
}
