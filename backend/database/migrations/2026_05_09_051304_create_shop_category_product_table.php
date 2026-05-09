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
        Schema::create('shop_category_product', function (Blueprint $table) {
            $table->id();

            // 1. product_id 외래키 수정 (참조 테이블명을 'shop_products'로 명시)
            $table->foreignId('product_id')
                ->constrained('shop_products') // 'products'가 아니라 'shop_products'여야 합니다.
                ->onDelete('cascade');

            // 2. category_id 외래키 수정 (참조 테이블명을 'shop_categories'로 명시)
            $table->foreignId('category_id')
                ->constrained('shop_categories') // 'categories'가 아니라 'shop_categories'여야 합니다.
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_category_product');
    }
};
