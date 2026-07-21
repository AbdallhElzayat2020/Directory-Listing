<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingImageGallery extends Model
{


    protected $table = 'listing_image_galleries';

    protected $fillable = [
        'listing_id', 'image'
    ];
}
