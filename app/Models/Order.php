<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'transaction_id',
        'user_id',
        'package_id',
        'payment_method',
        'payment_status',
        'base_amount',
        'base_currency',
        'paid_amount',
        'paid_currency',
        'purchase_date',
    ];

    /* relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function getCreatedAt()
    {
        return $this->created_at->format('d M Y');
    }
}
