<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingVideoGallery extends Model
{
    protected $fillable = [
        'listing_id',
        'video_url',
        'platform',
    ];

    public function listing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
