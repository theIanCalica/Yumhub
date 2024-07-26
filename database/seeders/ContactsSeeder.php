<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('contact_messages')->insert([
                'id' => (string) Str::uuid(),
                'fname' => $faker->firstName,
                'lname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'subject' => $faker->sentence,
                'message' => $faker->paragraph,
                'status' => $faker->randomElement(['Pending', 'Completed', 'In Progress']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
