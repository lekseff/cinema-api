<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    static array $categories = [
        '0+',
        '6+',
        '12+',
        '16+',
        '18+',
    ];

}
