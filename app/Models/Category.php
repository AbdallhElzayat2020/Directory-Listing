<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    // this for deletes image from storage when delete category but i'm use a observer class
//    protected static function booted()
//    {
//        static::deleted(function (Category $category) {
//            Storage::disk('categories')->delete($category->icon_image);
//            Storage::disk('categories')->delete($category->bg_image);
//        });
//    }
}
