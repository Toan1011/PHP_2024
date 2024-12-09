<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Medicine;
use Faker\Factory as Faker;
class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales')->delete();
        $faker = Faker::create();
        $medicine_ids = Medicine::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            Sale::create([
                'medicine_id' => $faker->randomElement($medicine_ids),
                'quantity' => $faker->numberBetween(1, 10),
                'sale_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'customer_phone' => $faker->numerify('090########'),
            ]);
        }
    }
}
