<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $fillable = [
        'listing_id',
        'owner_id',
        'sender_id',
        'name',
        'email',
        'phone',
        'subject',
        'is_read',
    ];


    protected $casts = [
        'is_read' => 'boolean',
    ];


    public function listing()
    {
        return $this->belongsTo(Listing::class)->withTrashed();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}

