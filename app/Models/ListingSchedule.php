<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingSchedule extends Model
{


    protected $fillable = [
        'listing_id', 'day', 'start_time', 'end_time', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByDay($query, $day)
    {
        return $query->where('day', $day);
    }


    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }


    public function scopeByListing($query, $listingId)
    {
        return $query->where('listing_id', $listingId);
    }

    // التحقق من وجود موعد نشط لنفس اليوم
    public static function hasActiveSchedule($listingId, $day, $excludeId = null)
    {
        $query = self::where('listing_id', $listingId)
            ->where('day', $day)
            ->where('status', 'active');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    // الـ Boot Events المعدلة
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($schedule) {
            if ($schedule->status === 'active') {
                $existing = self::where('listing_id', $schedule->listing_id)
                    ->where('day', $schedule->day)
                    ->where('status', 'active')
                    ->exists();

                if ($existing) {
                    return redirect()->back()
                        ->with('error', 'An active schedule already exists for ' . $schedule->day . '.');
                }
            }
        });

        static::updating(function ($schedule) {
            // التحقق فقط إذا كان الحالة active
            if ($schedule->status === 'active') {
                $existing = self::where('listing_id', $schedule->listing_id)
                    ->where('day', $schedule->day)
                    ->where('status', 'active')
                    ->where('id', '!=', $schedule->id)
                    ->exists();

                if ($existing) {
                    // إرجاع خطأ برسالة واضحة
                    throw new \Exception('An active schedule already exists for ' . $schedule->day . '.');
                }
            }
        });
    }


}
