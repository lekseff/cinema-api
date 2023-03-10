<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'plot',
        'actors',
        'timeline',
        'directors',
        'logo_mobile',
        'age_category',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Возрастная категория фильма
     * @return BelongsTo
     */
    public function ageCategory(): BelongsTo
    {
        return $this->belongsTo(AgeCategory::class, 'age_category', 'id');
    }

    /**
     * Страна производства фильма
     * @return BelongsToMany
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    /**
     * Все жанры фильма
     * @return BelongsToMany
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Все сеансы фильма
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'movie_id', 'id');
    }
}
