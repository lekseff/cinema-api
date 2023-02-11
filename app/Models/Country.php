<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    static array $countries = [
        'США',
        'Россия',
        'Франция',
        'Индия',
        'Бразилия',
        'Другое',
    ];
}
