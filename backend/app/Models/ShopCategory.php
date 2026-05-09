<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait; // 중첩 집합 기능을 위한 트레이트

class ShopCategory extends Model
{
    use HasFactory, NodeTrait, SoftDeletes;

    // 1. 연결할 테이블 명시
    protected $table = 'shop_categories';

    // 2. 대량 할당이 가능한 필드 정의
    protected $fillable = [
        'name',
        'slug',
        'parent_id', // Nested Set은 parent_id를 기반으로 구조를 파악합니다.
    ];

    // App\Models\ShopCategory.php
    public function parent()
    {
        return $this->belongsTo(ShopCategory::class, 'parent_id');
    }
    /**
     * 기본적으로 Nested Set은 _lft, _rgt 컬럼을 사용합니다.
     * 만약 마이그레이션에서 컬럼명을 바꾸지 않았다면 추가 설정은 필요 없습니다.
     */
}
