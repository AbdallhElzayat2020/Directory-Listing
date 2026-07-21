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


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($schedule) {
            // منع إضافة موعد نشط لنفس اليوم
            if ($schedule->status == 'active') {
                $existing = ListingSchedule::where('listing_id', $schedule->listing_id)
                    ->where('day', $schedule->day)
                    ->where('status', 'active')
                    ->exists();

                if ($existing) {
                    throw new \Exception('An active schedule already exists for this day.');
                }
            }
        });

        static::updating(function ($schedule) {
            // منع تحديث موعد ليوم يوجد فيه موعد نشط آخر
            if ($schedule->status == 'active') {
                $existing = ListingSchedule::where('listing_id', $schedule->listing_id)
                    ->where('day', $schedule->day)
                    ->where('status', 'active')
                    ->where('id', '!=', $schedule->id)
                    ->exists();

                if ($existing) {
                    throw new \Exception('An active schedule already exists for this day.');
                }
            }
        });
    }


}
