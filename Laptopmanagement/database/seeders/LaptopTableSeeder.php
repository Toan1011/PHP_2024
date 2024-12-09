<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class LaptopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('laptops')->insert([
                'brand' => $faker->company,
                'model' => $faker->word,
                'specifications' => $faker->sentence,
                'rental_status' => $faker->boolean
            ]);
        }
    }
}
