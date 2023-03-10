<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\GenreMovie;
use App\Models\CountryMovie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Movie\MovieResource;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Requests\Movie\CreateMovieRequest;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return MovieCollection
     */
    public function index(): MovieCollection
    {
        $movie = Movie::class::all();
        return new MovieCollection($movie);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMovieRequest $request
     * @return Response
     */
    public function store(CreateMovieRequest $request): Response
    {
        $validated = $request->validated();

        //  Формируем данные нового фильма
        $data = [
            'name' => $validated['name'],
            'directors' => $validated['directors'],
            'actors' => $validated['actors'],
            'timeline' => $validated['timeline'],
            'plot' => $validated['plot'],
            'logo' => '',
            'logo_mobile' => '',
            'age_category' => (int)$validated['ageCategory']
        ];

        $movie = Movie::class::create($data);

        //  При успешном сохранении в базу сохраняем фото в папку с id фильма
        $logoPath = Storage::disk('public')
            ->putFile("images/movies/${movie['id']}", $validated['logo']);

        $logoMobilePath = Storage::disk('public')
            ->putFile("images/movies/${movie['id']}", $validated['logoMobile']);

        //  Обновляем пути к фото
        $movie->update([
            'logo' => $logoPath,
            'logo_mobile' => $logoMobilePath,
        ]);

        // Добавляем страны в связывающую таблицу
        $countries = $validated['countries'];
        foreach ($countries as $country) {
            CountryMovie::class::create([
                'movie_id' => $movie->id,
                'country_id' => $country,
            ]);
        }

        // Добавляем жанры в связвающую таблицу
        $genres = $validated['genres'];
        foreach ($genres as $genre) {
            GenreMovie::class::create([
                'movie_id' => $movie->id,
                'genre_id' => $genre,
            ]);
        }

        return response($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return MovieResource
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return void
     */
    public function destroy(Movie $movie): void
    {
        $movie->delete();
    }
}
