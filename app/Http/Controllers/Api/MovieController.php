<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Movie\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::class::all();
        return new MovieCollection($movies);
    }

    public function show($id)
    {
        // :FIXME Добавить валидацию и проверку на fail
        $movie = Movie::class::findOrFail($id);
        return (new MovieResource($movie));
    }
}
