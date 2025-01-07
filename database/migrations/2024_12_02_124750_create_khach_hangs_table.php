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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khach_hang')->nullable();
            $table->string('ho_va_ten');
            $table->string('email');
            $table->string('password');
            $table->date('ngay_sinh');
            $table->string('so_dien_thoai');
            $table->integer('chung_minh_thu');
            $table->string('anh')->nullable();
            $table->integer('gioi_tinh');
            $table->integer('tinh_trang')->default(1);
            $table->string('hash_reset')->nullable();
            $table->string('hash_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
