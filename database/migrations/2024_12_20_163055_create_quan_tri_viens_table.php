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
        Schema::create('quan_tri_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_quan_tri_vien')->nullable();
            $table->string('ho_va_ten');
            $table->string('email');
            $table->string('password');
            $table->integer('trang_thai')->default(1);
            $table->string('ma_chuc_vu')->nullable();
            $table->integer('id_chuc_vu')->nullable();
            $table->integer('is_master')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quan_tri_viens');
    }
};
