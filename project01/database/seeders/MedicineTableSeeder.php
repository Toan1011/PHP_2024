<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\Sale;
use Faker\Factory as Faker;
class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Medicine::create([
                'name' => $faker->word,
                'brand' => $faker->word,
                'dosage' => $faker->word,
                'form' => $faker->word,
                'price' => $faker->numberBetween(100, 1000),
                'stock' => $faker->numberBetween(1, 100),
            ]);
        }
    }
}
