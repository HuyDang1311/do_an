<?php

use App\Models\Customer;
use Carbon\Carbon;
use Faker\Factory;
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
        $faker = Factory::create('en_US');
        $password = bcrypt('1234567');
        $now = Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'password' => $password,
                'address' => $faker->address,
                'avatar' => null,
                'email' => $faker->email,
                'name' => $faker->name,
                'status' => Customer::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Customer::insert($data);
    }
}
