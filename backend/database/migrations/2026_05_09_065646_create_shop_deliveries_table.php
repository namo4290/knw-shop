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
        Schema::create('shop_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_number')->unique(); // 배송 고유 번호
            $table->string('carrier')->nullable();       // 택배사 (CJ, 로젠 등)
            $table->string('tracking_number')->nullable(); // 운송장 번호
            $table->string('status')->default('ready');  // ready, shipped, delivered
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_deliveries');
    }
};
