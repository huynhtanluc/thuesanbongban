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
        Schema::create('thue_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_thue_san')->nullable();
            $table->dateTime('thoi_gian_bat_dau');
            $table->dateTime('thoi_gian_ket_thuc');
            $table->decimal('so_gio_thue');
            $table->integer('trang_thai')->default(0);
            $table->double('thanh_tien');
            $table->string('ma_khach_hang');
            $table->integer('id_khach_hang');
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
        Schema::dropIfExists('thue_sans');
    }
};
