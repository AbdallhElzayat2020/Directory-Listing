<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_type',
        'name',
        'slug',
        'price',
        'description',
        'number_of_days',
        'number_of_listings',
        'number_of_photos',
        'number_of_videos',
        'number_of_amenities',
        'number_of_featured_listings',
        'show_at_home',
        'status',
    ];


    /* --------------- FUNCTIONS --------------- */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeShowAtHome(Builder $query): Builder
    {
        return $query->where('show_at_home', 'yes');
    }


    /* --------------- Relations --------------- */

    public function features(): HasMany
    {
        return $this->hasMany(PackageFeature::class,'package_id','id');
    }
}
