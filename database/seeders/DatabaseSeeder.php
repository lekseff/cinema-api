<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
//            MovieSeeder::class,
//            HallSeeder::class,
//            CountryMovieSeeder::class,
//            GenreMovieSeeder::class,
        ]);
    }
}
