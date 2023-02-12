<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    static array $countries = [
        'США',
        'Индия',
        'Россия',
        'Канада',
        'Франция',
        'Новая Зеландия',
        'Великобритания',
        'Другое',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
