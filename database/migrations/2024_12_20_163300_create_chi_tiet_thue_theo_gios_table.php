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
        Schema::create('chi_tiet_thue_theo_gios', function (Blueprint $table) {
            $table->id();
            $table->string('ma_chi_tiet_thue')->nullable();
            $table->dateTime('thoi_gian_bat_dau');
            $table->dateTime('thoi_gian_ket_thuc');
            $table->decimal('tong_tien');
            $table->integer('trang_thai')->default(1);
            $table->string('ma_khung_gio');
            $table->string('ma_thue_san');
            $table->integer('id_khung_gio');
            $table->integer('id_thue_san');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_thue_theo_gios');
    }
};
