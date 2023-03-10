<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
