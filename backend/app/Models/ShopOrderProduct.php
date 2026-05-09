<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrderProduct extends Model
{
    use HasFactory;

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopOrderProduct extends Model
{
    // 주문 당시의 정보를 보존해야 하므로 fillable 설정
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name', // 스냅샷
        'unit_price',   // 구매 당시 가격
        'quantity',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
        'unit_price' => 'decimal:2',
    ];

    // 주문 마스터와의 관계
    public function order(): BelongsTo
    {
        return $this->belongsTo(ShopOrder::class, 'order_id');
    }

    // 원본 상품과의 관계 (상품이 삭제될 수 있으므로 nullable 대응 필요)
    public function product(): BelongsTo
    {
        return $this->belongsTo(ShopProduct::class, 'product_id');
    }

    // 개별 품목 합계 금액 (단가 * 수량)
    public function getTotalPriceAttribute()
    {
        return $this->unit_price * $this->quantity;
    }
}
