<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            'floor_count' => 2,
            'room_count' => 3,
            'building_name' => "A",
            'phone' => "0909472028",
            'price_water' => 30,
            'price_electric' => 8,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
    }
}
