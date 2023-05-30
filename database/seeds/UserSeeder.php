<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_members')->insert([
            'first_name' => "วศิน",
            'last_name' => "ชาญชัยสวัสดิ์",
            'phone' => "0977429835",
            'citizen' => 4362012546587,
            'line' => "buferfill",
            'facebook' => "Chanchaisawat Yongkang",
            'email' => "user@gmail.com",
            'password' => Hash::make("123456"),
            'date_of_birth' => date('Y-m-d H:i:s'),
            'emergency_name' => "วิโรจน์ ชาญชัยสวัสดิ์",
            'relationship' => "บิดา",
            'phone_relationship' => "0973524981",
            'description' => "กรณีติดต่อผู้เช่าโดยตรงไม่ได้",
            'status' => 1,
            'day_in' => date('Y-m-d H:i:s'),
            'day_out' => date('Y-m-d H:i:s'),
            'amount_people' => 1,
            'period' => "สิ้นสุดสัญญา",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        //
    }
}
