<?php

use App\Models\Company;
use App\Models\Customer;
use Carbon\Carbon;
use Faker\Factory;
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
        $faker = Factory::create('en_US');
        $now = Carbon::now();
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'name' => $faker->name,
                'address' => $faker->address,
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'email' => $faker->email,
                'status' => Customer::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Company::insert($data);
    }
}
