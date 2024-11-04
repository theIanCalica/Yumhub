<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuisines')->insert([
            [
                'name' => "Italian",
                'desc' => "Celebrated for its hearty pasta dishes, savory pizzas, and rich sauces, Italian cuisine emphasizes fresh ingredients like tomatoes, basil, and olive oil.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/XIdL1ecrMIDkzyhibqOoPLYlkvomHDL9jrmfPixz.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Chinese",
                'desc' => "Known for its diverse regional flavors, Chinese cuisine includes everything from delicate dim sum and spicy Szechuan dishes to savory stir-fries and flavorful noodles.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/v7NGUnIFJKLqdoBYqU9O2HdPZR3f8NT6kMxkvujX.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Japanese",
                'desc' => "Renowned for its emphasis on fresh, seasonal ingredients, Japanese cuisine features dishes like sushi, sashimi, and ramen, often highlighting subtle and refined flavors.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/MoktHdBegZoUUNJLtABAfRDswjEoydJ3DSBHVHFW.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Mexican",
                'desc' => "Characterized by vibrant flavors and ingredients, Mexican cuisine offers a range of dishes from spicy tacos and enchiladas to rich moles and fresh guacamole.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/9rVHsApILffwo8vHw6XN5aAMI8iSXEam5oNrLCFy.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Filipino",
                'desc' => "Filipino cuisine is a flavorful mix of indigenous, Spanish, Chinese, and American influences, known for its hearty dishes like adobo, sinigang, and lechon. It balances savory, sweet, sour, and spicy flavors, often showcased in both everyday meals and festive dishes.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/3lrQXBTX8Ool2bV1FexFDZB0rlf3COrATyKRKRXw.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Korean",
                'desc' => "Known for its bold flavors and fermented foods, Korean cuisine includes dishes like kimchi, bulgogi, and bibimbap, often incorporating spicy, tangy, and savory elements.",
                'img_url' => "http://127.0.0.1:8000/storage/cuisines/hu94AoJwpC386Psq7HiGA29eNvF12FJMI7kUlf75.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
