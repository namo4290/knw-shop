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
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 주문 번호 (예: 20260509-ABCDE)
            $table->string('order_number')->unique();

            // 상태 관리 (enum 또는 string)
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled, refunded

            // 금액 관련
            $table->decimal('total_price', 12, 2);    // 총 결제 금액
            $table->decimal('shipping_price', 12, 2)->default(0); // 배송비

            // 배송 정보 (스냅샷: 회원이 주소를 바꿔도 주문 당시 주소는 유지되어야 함)
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->string('shipping_zipcode');
            $table->text('notes')->nullable(); // 배송 요청 사항

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_order');
    }
};
