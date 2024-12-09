<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Library;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->delete();
        $faker = Faker::create();
        $libraries = Library::all()->pluck('id')->toArray();
        for ($i = 0; $i < 50; $i++) {
            Book::create([
                'title' => $faker->sentence,
                'author' => $faker->name,
                'publication_year' => $faker->year,
                'genre' => $faker->word,
                'library_id' => $faker->numberBetween(1, 20),
            ]);
        }
    }
}
