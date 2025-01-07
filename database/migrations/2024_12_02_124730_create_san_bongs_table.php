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
        Schema::create('san_bongs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san');
            $table->string('ten_san');
            $table->string('dien_tich');
            $table->string('gia_dau_thau')->nullable();
            $table->string('trang_thai')->default(1);
            $table->string('trang_thai_dau_thau')->default(0);
            $table->string('phan_tram_coc')->nullable();
            $table->integer('id_chu_san')->nullable();
            $table->integer('id_khu_vuc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_bongs');
    }
};
