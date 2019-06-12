<?php

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        $password = bcrypt('12345678');
        $now = Carbon::now();
        $data[] = [
            'name' => $faker->name,
            'email' => $faker->email,
            'username' => 'super_admin',
            'password' => $password,
            'address' => $faker->address,
            'phone_number' => substr($faker->phoneNumber, 0, 15),
            'company_id' => null,
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => Customer::STATUS_USING,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => 'username_' . $i,
                'password' => $password,
                'address' => $faker->address,
                'phone_number' => substr($faker->phoneNumber, 0, 15),
                'company_id' => rand(1, 50),
                'role' => rand(User::ROLE_ADMIN, User::ROLE_DRIVER),
                'status' => User::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        User::insert($data);
    }
}
