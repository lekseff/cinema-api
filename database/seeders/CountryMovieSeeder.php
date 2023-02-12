<?php

namespace Database\Seeders;

use App\Models\CountryMovie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountryMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        :FIXME Посмотреть вариант добавлять данные в таблицу
                //  Дивергент
        CountryMovie::factory()->create(
            [
                'movie_id' => 1,
                'country_id' => 1,
            ]
        );

//  Путешествие 2
        CountryMovie::factory()->create(
            [
                'movie_id' => 2,
                'country_id' => 1,
            ]
        );

//  Властелин колец. Две крепости
        CountryMovie::factory()->create(
            [
                'movie_id' => 3,
                'country_id' => 1,
            ]
        );
        CountryMovie::factory()->create(
            [
                'movie_id' => 3,
                'country_id' => 6,
            ]
        );

//  Джокер
        CountryMovie::factory()->create(
            [
                'movie_id' => 4,
                'country_id' => 1,
            ]
        );
        CountryMovie::factory()->create(
            [
                'movie_id' => 4,
                'country_id' => 4,
            ]
        );

//  Начало
        CountryMovie::factory()->create(
            [
                'movie_id' => 5,
                'country_id' => 1,
            ]
        );
        CountryMovie::factory()->create(
            [
                'movie_id' => 5,
                'country_id' => 7,
            ]
        );
    }
}
