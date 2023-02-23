<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    use HasFactory;

    public $table = 'genre_movie';

    protected $fillable = [
        'genre_id',
        'movie_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

//  Начальные жанры для фильма
    static array $genresData = [
        1 => [2, 10, 5, 6],
        2 => [2, 5, 1, 7, 8],
        3 => [2, 7, 3],
        4 => [3, 9],
        5 => [2, 5, 9, 3, 10],
    ];
}
