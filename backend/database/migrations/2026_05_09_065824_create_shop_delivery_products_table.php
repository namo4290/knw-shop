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
        Schema::create('shop_delivery_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->constrained('shop_deliveries')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('shop_orders');
            $table->foreignId('order_product_id')->constrained('shop_order_products'); // 주문 상세 모델 참조
            $table->integer('quantity'); // 이번 배송에 포함된 수량
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_delivery_products');
    }
};
