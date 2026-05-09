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
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // 상품명
            $table->string('slug')->unique(); // URL용 슬러그
            $table->text('description')->nullable(); // 상세 설명
            $table->decimal('price', 12, 2); // 가격 (정밀도 고려)
            $table->integer('stock')->default(0); // 재고
            $table->boolean('is_visible')->default(true); // 노출 여부
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
