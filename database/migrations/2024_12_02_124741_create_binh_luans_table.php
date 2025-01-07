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
        Schema::create('binh_luans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_binh_luan')->nullable();
            $table->text('noi_dung_binh_luan');
            $table->string('trang_thai')->default(1);
            $table->string('ma_bai_viet');
            $table->string('ma_khach_hang');
            $table->integer('id_khach_hang');
            $table->integer('id_bai_viet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luans');
    }
};
