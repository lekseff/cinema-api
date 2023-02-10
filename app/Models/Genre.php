<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    static array $genres = [
        'Комедия ',
        'Фантастика',
        'Ужасы',
        'Боевик ',
        'Мелодрама',
        'Мистика ',
        'Другое ',
    ];

    use HasFactory;
}
