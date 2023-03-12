<?php

namespace App\Services;

use App\Models\Genre;

class GenreService
{
    public function create($params): Genre
    {
        return Genre::class::create([
            'name' => $params['name']
        ]);
    }
}
