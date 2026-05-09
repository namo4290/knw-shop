<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_cart', function (Blueprint $table) {
            $table->id();

            // 1. 회원 및 상품 참조 (Foreign Keys)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained('shop_products')->onDelete('cascade');

            // 2. 수량 및 옵션 정보
            $table->integer('quantity')->default(1)->unsigned(); // 담은 수량

            // 상품 옵션이 있을 경우 JSON 타입으로 저장하면 유연합니다.
            $table->json('options')->nullable();

            // 3. 상태 및 관리
            $table->boolean('is_active')->default(true); // 장바구니 내 선택 여부 (체크박스 상태 저장용)
            $table->timestamps();

            // 중복 방지: 같은 회원, 같은 상품, (같은 옵션)인 경우 로우가 겹치지 않게 유니크 설정 고려
            // $table->unique(['user_id', 'product_id', 'options_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_cart');
    }
};
