<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'fname' => 'Ian Gabriel',
                'lname' => "Calica",
                'gender' => "Men",
                "dob" => "2004-06-05",
                "email" => "iggc654@gmail.com",
                "phoneNumber" => "09613886156",
                'address' => "Central Bicutan, Taguig City",
                'password' => Hash::make('123456'),
                'role' => "Admin",
                'status' => 1,
                'email_verified_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => Str::uuid(),
                'fname' => 'Ian Gabriel',
                'lname' => "Calica",
                'gender' => "Men",
                "dob" => "2004-06-05",
                "email" => "iggc654a@gmail.com",
                "phoneNumber" => "09613886155",
                'address' => "Central Bicutan, Taguig City",
                'password' => Hash::make('123456'),
                'role' => "Seller",
                'status' => 1,
                'email_verified_at' => Carbon::create(2024, 7, 20, 7, 1, 12),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'fname' => 'Ian Gabriel',
                'lname' => "Calica",
                'gender' => "Men",
                "dob" => "2004-06-05",
                "email" => "iggc654ab@gmail.com",
                "phoneNumber" => "09613886151",
                'address' => "Central Bicutan, Taguig City",
                'password' => Hash::make('123456'),
                'role' => "Customer",
                'status' => 1,
                'email_verified_at' => Carbon::create(2024, 7, 20, 7, 1, 12),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
