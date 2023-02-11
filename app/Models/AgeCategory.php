<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    static array $categories = [
        '0+',
        '6+',
        '12+',
        '16+',
        '18+',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'age_category', 'id');
    }

}
