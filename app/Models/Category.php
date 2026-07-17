<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

    // this for deletes image from storage when delete category but i'm use a observer class
//    protected static function booted()
//    {
//        static::deleted(function (Category $category) {
//            Storage::disk('categories')->delete($category->icon_image);
//            Storage::disk('categories')->delete($category->bg_image);
//        });
//    }
}
