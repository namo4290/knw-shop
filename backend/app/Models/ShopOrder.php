<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'options', 'is_active'];

    // JSON 필드를 배열로 자동 변환
    protected $casts = [
        'options' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ShopProduct::class);
    }

    // 접근자(Accessor)를 통해 합계 금액 계산 로직 추가 가능
    public function getTotalPriceAttribute()
    {
        return $this->product->price * $this->quantity;
    }
}
