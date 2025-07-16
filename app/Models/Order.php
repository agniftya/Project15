<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'shipping_address',
        'payment_method',
        'total_amount',
        'status',
        'tracking_number'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}