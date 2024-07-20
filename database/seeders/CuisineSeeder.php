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
                'name' => "American Cuisine",
                'desc' => "American cuisine reflects the history of the United States, blending the culinary contributions of various groups of people from around the world, including indigenous Native Americans, early settlers, and immigrants. Iconic American dishes include hamburgers, fries, barbecue, and apple pie. Fast food culture, diners, and regional specialties also play a significant role in defining American food.",
                'img_url' => "public/cuisines/qRLnyVZH4iNY60u5SkbY4zNKQmTAi4yXOeob1XMz.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Italian Cuisine",
                'desc' => "Italian cuisine is known for its regional diversity, especially between the north and the south of Italy. It offers an abundance of taste, and is one of the most popular in the world. It is characterized by its simplicity, with many dishes having only two to four main ingredients.",
                'img_url' => "public/cuisines//4fBqLBzTXRwpwJDjhUfA5KJ95ZrUP6Q073pDBGEq.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Japanese Cuisine",
                'desc' => "Japanese cuisine encompasses the regional and traditional foods of Japan, which have developed through centuries of social and economic changes. Traditional Japanese cuisine is based on rice with miso soup and other dishes; there is an emphasis on seasonal ingredients.",
                'img_url' => "public/cuisines/KNc0tCPzAfRsmxwjb3st9qvoBm96LpGC2dwb2dBS.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Mexican Cuisine",
                'desc' => "Mexican cuisine is known for its bold flavors and vibrant colors. It is created mostly with ingredients native to Mexico, as well as those brought over by the Spanish conquistadors. Common ingredients include corn, beans, chili peppers, tomatoes, and avocados.",
                'img_url' => "public/cuisines/FYqQhMmWEmMv5CSMSqxzk515zijxO43lYgB2TEA6.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => "Indian Cuisine",
                'desc' => "Indian cuisine consists of a wide variety of regional and traditional cuisines native to the Indian subcontinent. It features a wide array of dishes and cooking techniques, and is known for its extensive use of spices, herbs, vegetables, and fruits.",
                'img_url' => "public/cuisines/Y2I337LZZzec7LRS3GWFxSLfoO47858cOCqt0ZGR.jpg",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
