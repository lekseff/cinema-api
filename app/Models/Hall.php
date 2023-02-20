<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool $available
 */
class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rows',
        'places',
        'price',
        'available',
        'price_vip',
        'structure'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'available' => 'boolean'
    ];

    public function isActive(): bool
    {
        return $this->available;
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'hall_id', 'id');
    }
}
