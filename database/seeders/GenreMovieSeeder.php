<?php

namespace Database\Seeders;

use App\Models\GenreMovie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (GenreMovie::$genresData as $key => $genres) {
            foreach ($genres as $genre) {
                GenreMovie::factory()->create(
                    [
                        'movie_id' => $key,
                        'genre_id' => $genre,
                    ]
                );
            }

        }
    }
}
