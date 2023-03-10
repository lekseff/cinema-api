<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\GenreMovie;
use App\Models\CountryMovie;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public Movie $movie;

    /**
     * Создает новый фильм
     * @param $params
     * @return Movie
     */
    public function create($params): Movie
    {
        //  Формируем данные нового фильма
        $data = [
            'name' => $params['name'],
            'directors' => $params['directors'],
            'actors' => $params['actors'],
            'timeline' => $params['timeline'],
            'plot' => $params['plot'],
            'logo' => '',
            'logo_mobile' => '',
            'age_category' => (int)$params['ageCategory']
        ];

        $this->movie = Movie::class::create($data);

        $logoPath = $this->saveImage($params['logo']);
        $logoMobilePath = $this->saveImage($params['logoMobile']);

        //  Обновляем пути к фото
        $this->movie->update([
            'logo' => $logoPath,
            'logo_mobile' => $logoMobilePath,
        ]);

        $this->createCountries($params['countries']);    // Добавляем страны в связывающую таблицу
        $this->createGenres($params['genres']);   // Добавляем жанры в связвающую таблицу

        return $this->movie;
    }

    /**
     * Сохраняет изображение
     * @param $file - файл изображения
     * @return string - путь до изображения
     */
    private function saveImage($file): string
    {
        return Storage::disk('public')
            ->putFile("images/movies/{$this->movie['id']}", $file);
    }

    /**
     * Добавляет страны в связывающую таблицу
     * @param $countries
     * @return void
     */
    private function createCountries($countries): void
    {
        foreach ($countries as $country) {
            CountryMovie::class::create([
                'movie_id' => $this->movie['id'],
                'country_id' => $country,
            ]);
        }
    }

    /**
     * Добавляет жанры в связывающую таблицу
     * @param $genres
     * @return void
     */
    private function createGenres($genres): void
    {
        foreach ($genres as $genre) {
            GenreMovie::class::create([
                'movie_id' => $this->movie['id'],
                'genre_id' => $genre,
            ]);
        }
    }
}
