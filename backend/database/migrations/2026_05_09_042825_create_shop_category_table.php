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
        // 테이블명을 보통 복수형인 'categories'로 사용하는 것이 라라벨 관례입니다.
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 카테고리 이름
            $table->string('slug')->unique(); // URL 등에 사용될 고유 식별값

            // Nested Set 필드 생성 (_lft, _rgt, parent_id 추가됨)
            $table->nestedSet();

            $table->timestamps(); // 생성일, 수정일
            $table->softDeletes(); // 데이터 복구를 위한 소프트 삭제 (선택사항)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table(...) 내부의 dropNestedSet()이 에러를 일으키므로 주석 처리하거나
        // 아래와 같이 테이블 전체 삭제만 남깁니다.
        //  Schema::dropIfExists('category');

        // Schema::table('categories', function (Blueprint $table) {
        //     $table->dropNestedSet(); // 중첩 집합 컬럼 삭제
        // });
        Schema::dropIfExists('categories');
        Schema::dropIfExists('shop_categories');
    }
};
