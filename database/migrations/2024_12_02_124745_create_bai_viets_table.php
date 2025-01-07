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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id();
            $table->string('ma_bai_viet')->nullable();
            $table->string('ten_bai_viet');
            $table->longText('noi_dung');
            $table->longText('noi_dung_ngan');
            $table->longText('hinh_anh')->nullable();
            $table->string('trang_thai')->default(1);
            $table->string('ma_chu_san');
            $table->integer('id_chu_san');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};
