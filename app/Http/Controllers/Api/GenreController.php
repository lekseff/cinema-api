<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Resources\Genre\GenreCollection;

class GenreController extends Controller
{
    public function index(): GenreCollection
    {
        $genres = Genre::query()->orderBy('name')->get();
        return new GenreCollection($genres);
    }
}
