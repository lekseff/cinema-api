<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Genre\GenreCollection;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all(['id', 'name'])->sortBy('name');
        return new GenreCollection($genres);
    }
}
