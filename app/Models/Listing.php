<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'location_id',
        'amenity_id',
        'package_id',
        'image',
        'thumbnail_image',
        'title',
        'slug',
        'description',
        'phone',
        'email',
        'address',
        'website',
        'facebook_link',
        'x_link',
        'instagram_link',
        'linkedin_link',
        'whatsapp_link',
        'google_map_embed_code',
        'views',
        'attachments',
        'expired_date',
        'status',
        'is_approved',
        'is_verified',
        'is_featured',
        'seo_title',
        'seo_description',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('is_approved', 'no');
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 'inactive');
    }

    // -------------- Relationships -----------------
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class,
            'listing_amenities',
            'listing_id',
            'amenity_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImageGallery::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(ListingVideoGallery::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ListingSchedule::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
