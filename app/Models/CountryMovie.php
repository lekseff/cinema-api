<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMovie extends Model
{
    use HasFactory;

    public $table = 'country_movie';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
