<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'title', 'slug', 'notes', 'status', 'show_at_home'
    ];
}
