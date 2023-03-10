<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryMovie extends Model
{
    use HasFactory;

    public $table = 'country_movie';

    protected $fillable = [
        'country_id',
        'movie_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
