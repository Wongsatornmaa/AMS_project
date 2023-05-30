<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => 1,
            'number_room' => "A101",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 1,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => "",
            'number_room' => "A102",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 0,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => "",
            'number_room' => "A103",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 0,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => "",
            'number_room' => "A201",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 0,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => "",
            'number_room' => "A202",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 0,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('rooms')->insert([
            'building_id' => 1,
            'member_id' => "",
            'number_room' => "A203",
            'mitor_cable' => 10,
            'mitor_wifi' => 10,
            'status' => 0,
            'rent' => 5000,
            'deposit' => 1000,
            'transaction_log' => "",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
    }
}
