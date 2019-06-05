<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CustomerTableSeeder::class);
         $this->call(CompanyTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(BusStationTableSeeder::class);
         $this->call(CarTableSeeder::class);
         $this->call(PlanTableSeeder::class);
//         $this->call(SeatTableSeeder::class);
         $this->call(RateTableSeeder::class);
//         $this->call(TicketTableSeeder::class);
         $this->call(OrderTableSeeder::class);
//         $this->call(ScheduleTableSeeder::class);
    }
}
