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
        Schema::create('shop_payments', function (Blueprint $table) {
            $table->id();
            // 주문과의 1:N 관계
            $table->foreignId('order_id')->constrained('shop_orders')->onDelete('cascade');

            $table->string('method'); // card, transfer, vbank, point, pay(kakao/toss)
            $table->decimal('amount', 12, 2); // 결제/취소 금액
            $table->string('currency')->default('KRW');

            // 결제 상태: ready(대기), success(성공), failed(실패), cancelled(취소)
            $table->string('status')->default('ready');

            // 외부 연동 정보
            $table->string('transaction_id')->nullable()->index(); // PG사 거래 고유번호
            $table->json('payload')->nullable(); // PG사에서 받은 전체 응답값(로그용)

            $table->timestamp('paid_at')->nullable(); // 실제 결제 완료 시점
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_payments');
    }
};
