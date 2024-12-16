<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class IssueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $computerIds = DB::table('computers')->pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            DB::table('issues')->insert([
                'reported_by' => $faker->name,
                'reported_date' => $faker->dateTime,
                'description' => $faker->text,
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'computer_id' => $faker->randomElement($computerIds),
            ]);
        }
    }
}
