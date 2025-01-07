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
        Schema::create('chu_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_chu_san')->nullable();
            $table->double('gia_thue_san');
            $table->string('thoi_han');
            $table->integer('trang_thai_duyet')->default(0);
            $table->string('ma_khach_hang');
            $table->integer('id_khach_hang');
            $table->string('ma_san');
            $table->integer('id_san');
            $table->string('ma_quan_tri_vien')->nullable();
            $table->integer('id_quan_tri_vien')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chu_sans');
    }
};
