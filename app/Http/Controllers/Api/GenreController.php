<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Services\GenreService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Genre\GenreResource;
use App\Http\Resources\Genre\GenreCollection;
use App\Http\Requests\Genre\CreateGenreRequest;

class GenreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['expect' => ['index']]);
    }

    /**
     * @return GenreCollection
     */
    public function index(): GenreCollection
    {
        $genres = Genre::query()->orderBy('name')->get();
        return new GenreCollection($genres);
    }


    /**
     * @param CreateGenreRequest $request
     * @param GenreService $service
     * @return GenreResource
     */
    public function store(CreateGenreRequest $request, GenreService $service): GenreResource
    {
        $validated = $request->validated();
        $genre = $service->create($validated);
        return new GenreResource($genre);
    }


    /**
     * @param Genre $genre
     * @return void
     */
    public function destroy(Genre $genre): void
    {
        $genre->delete();
    }
}
