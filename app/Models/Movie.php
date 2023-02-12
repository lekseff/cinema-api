<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Возрастная категория фильма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ageCategory()
    {
        return $this->belongsTo(AgeCategory::class, 'age_category', 'id');
    }

    /**
     * Страна производства фильма
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
