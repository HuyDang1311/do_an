<?php

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
        $faker = \Faker\Factory::create('en_US');
        $password = bcrypt('12345678');
        $now = \Carbon\Carbon::now();

        $data[] = [
            'name' => $faker->name,
            'email' => $faker->email,
            'username' => 'super_admin',
            'password' => $password,
            'address' => $faker->address,
            'phone_number' => substr($faker->phoneNumber, 0, 15),
            'company_id' => null,
            'role' => \App\Models\User::ROLE_SUPER_ADMIN,
            'status' => \App\Models\Customer::STATUS_USING,
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
                'role' => rand(\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER),
                'status' => \App\Models\User::STATUS_USING,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\User::insert($data);
    }
}
