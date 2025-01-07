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
        Schema::create('mat_bang_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_mat_bang');
            $table->integer('id_chu_san');
            $table->string('dia_chi');
            $table->integer('trang_thai')->default(1);
            $table->integer('id_thanh_pho');
            $table->integer('id_quan_huyen');
            $table->integer('id_phuong_xa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mat_bang_sans');
    }
};
