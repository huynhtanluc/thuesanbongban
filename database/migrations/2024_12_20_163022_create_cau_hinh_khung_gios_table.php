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
        Schema::create('cau_hinh_khung_gios', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khung_gio')->nullable();
            $table->time('thoi_gian_bat_dau');
            $table->time('thoi_gian_ket_thuc');
            $table->decimal('gia_tien_gio');
            $table->integer('trang_thai')->default(1);
            $table->string('ma_san');
            $table->integer('id_san');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cau_hinh_khung_gios');
    }
};
