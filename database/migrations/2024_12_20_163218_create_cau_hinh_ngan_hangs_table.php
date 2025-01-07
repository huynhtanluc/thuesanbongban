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
        Schema::create('cau_hinh_ngan_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_cau_hinh_ngan_hang')->nullable();
            $table->string('ten_chu_tai_khoan');
            $table->string('so_tai_khoan');
            $table->string('ngan_hang');
            $table->string('anh_qr');
            $table->integer('trang_thai')->default(1);
            $table->string('ma_khach_hang');
            $table->integer('id_khach_hang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cau_hinh_ngan_hangs');
    }
};
