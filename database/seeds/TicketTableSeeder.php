<?php

use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $now = \Carbon\Carbon::now();

        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'money' => 50000,
                'seat_id' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        \App\Models\Ticket::insert($data);
    }
}
