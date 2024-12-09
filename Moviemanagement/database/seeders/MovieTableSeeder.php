<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $cinemaIds = DB::table('cinemas')->pluck('id');
        DB::table('movies')->insert([
            'title' => $faker->name,
            'director' => $faker->address,
            'release_date' => $faker->date,
            'duration' => $faker->numberBetween(50, 100),
            'cinema_id' => $faker->randomElement($cinemaIds)
        ]);
    }
}
