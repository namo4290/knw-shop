<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopPayment extends Model
{
    protected $fillable = [
        'order_id', 'method', 'amount', 'status',
        'transaction_id', 'payload', 'paid_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(ShopOrder::class);
    }
}
