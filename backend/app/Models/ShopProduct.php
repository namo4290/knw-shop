<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopProduct extends Model
{
    use HasFactory, SoftDeletes;

    // 1. 연결할 테이블 명시
    protected $table = 'shop_products';

    // 2. 대량 할당이 가능한 필드 정의
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_visible',
    ];

    // App\Models\ShopCategory.php
    public function categories()
    {
        // 다대다 관계 정의
        return $this->belongsToMany(ShopCategory::class, 'shop_category_product', 'product_id', 'category_id');
    }
    /**
     * 기본적으로 Nested Set은 _lft, _rgt 컬럼을 사용합니다.
     * 만약 마이그레이션에서 컬럼명을 바꾸지 않았다면 추가 설정은 필요 없습니다.
     */
}
