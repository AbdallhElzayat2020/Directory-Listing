<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'title', 'slug', 'notes', 'status', 'show_at_home'
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 'inactive');
    }




    public function scopeIsVerified(Builder $query): Builder
    {
        return $query->where('is_verified', 'yes');
    }

    public function scopeShowAtHome(Builder $query): Builder
    {
        return $query->where('show_at_home', true);
    }

    // -------------- Relationships -----------------

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
