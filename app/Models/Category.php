<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'icon_image',
        'status',
        'description',
        'show_at_home',
        'bg_image',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 'inactive');
    }

    // -------------- Relationships -----------------
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
