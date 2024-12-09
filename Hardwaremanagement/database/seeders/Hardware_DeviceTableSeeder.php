<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class Hardware_DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('hardwaredevices')->insert([
                'device_name' => $faker->name,
                'type' => $faker->address,
                'status' => $faker->boolean,
                'center_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
