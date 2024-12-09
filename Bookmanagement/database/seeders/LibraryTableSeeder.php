<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Library;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            Library::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'contact_number' => $faker->phoneNumber,
            ]);
        }
    }
}
