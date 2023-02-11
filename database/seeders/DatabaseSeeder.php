<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AgeCategory;
use Database\Factories\AgeCategoryFactory;
use Illuminate\Database\Seeder;
use App\Models\Country;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            AgeCategorySeeder::class,
            GenreSeeder::class,
            UserSeeder::class,
            MovieSeeder::class
        ]);
    }
}
