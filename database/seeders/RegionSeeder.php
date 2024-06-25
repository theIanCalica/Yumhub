<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['id' => '1bd99789-36ec-4def-b099-5a289f8f0459', 'regionName' => 'Region I - Ilocos Region', 'created_at' => now()],
            ['id' => 'ed076277-2e4b-42bf-9f9e-6e54c57ab0bf', 'regionName' => 'Region II - Cagayan Valley', 'created_at' => now()],
            ['id' => '4a8d3de2-a1c0-4e19-a70c-de0dd0865a2e', 'regionName' => 'Region III - Central Luzon', 'created_at' => now()],
            ['id' => '333cade5-5300-4b68-87a1-fa2945a9c5e9', 'regionName' => 'Region IV-A - CALABARZON', 'created_at' => now()],
            ['id' => '08340666-5e03-4956-a51c-d66210db0e1c', 'regionName' => 'Region V - Bicol Region', 'created_at' => now()],
            ['id' => 'e8252541-bdca-4d9e-baab-d770d1fa9f72', 'regionName' => 'Region VI - Western Visayas', 'created_at' => now()],
            ['id' => 'e0b59acf-dbb5-4e35-af68-d39066ef6e06', 'regionName' => 'Region VII - Central Visayas', 'created_at' => now()],
            ['id' => '4f1d74ee-cb0a-4c21-91f7-4861d57c0f14', 'regionName' => 'Region VIII - Eastern Visayas', 'created_at' => now()],
            ['id' => 'bfb98162-8bf1-426b-bf09-a0db0eac4232', 'regionName' => 'Region IX - Zamboanga Peninsula', 'created_at' => now()],
            ['id' => '6193eddb-f871-4d9f-9a0a-c686f1f3adee', 'regionName' => 'Region X - Northern Mindanao', 'created_at' => now()],
            ['id' => '4693aae0-6a7a-46e5-9bfb-5b5e44579adf', 'regionName' => 'Region XI - Davao Region', 'created_at' => now()],
            ['id' => 'ca3467d1-031e-43e7-a369-747787ae902a', 'regionName' => 'Region XII - SOCCSKSARGEN', 'created_at' => now()],
            ['id' => '1e96cf28-c453-4969-81c7-13c9ec46222a', 'regionName' => 'Region XIII - Caraga', 'created_at' => now()],
            ['id' => '29394023-5fa0-4380-b69b-eec37947c79c', 'regionName' => 'NCR - National Capital Region', 'created_at' => now()],
            ['id' => 'b00ba139-2524-4470-8f37-e1d552e53d18', 'regionName' => 'CAR - Cordillera Administrative Region', 'created_at' => now()],
            ['id' => 'bc4cbf06-486e-414e-8231-77ff031bf189', 'regionName' => 'BARMM - Bangsamoro Autonomous Region in Muslim Mindanao', 'created_at' => now()],
        ]);
    }
}
