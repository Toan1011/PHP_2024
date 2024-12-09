<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CinemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('cinemas')->insert([
            'name' => $faker->name,
            'location' => $faker->address,
            'total_seat' => $faker->numberBetween(50, 100),
        ]);
    }
}
