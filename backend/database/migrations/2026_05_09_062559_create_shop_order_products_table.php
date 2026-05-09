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
        Schema::create('shop_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('shop_orders')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('shop_products')->onDelete('set null');

            // ★ 중요: 주문 당시의 가격과 이름을 기록 (상품 정보가 변해도 주문 내역은 변하면 안 됨)
            $table->string('product_name');
            $table->decimal('unit_price', 12, 2);
            $table->integer('quantity');

            $table->json('options')->nullable(); // 선택한 옵션 (색상, 사이즈 등)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_order_products');
    }
};
