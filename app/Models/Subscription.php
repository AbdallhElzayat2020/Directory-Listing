<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'package_id', 'order_id', 'purchase_date', 'expire_date', 'status'
    ];
}
