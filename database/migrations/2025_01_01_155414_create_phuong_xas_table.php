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
        Schema::create('phuong_xas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phuong_xa');
            $table->integer('trang_thai')->default(0);
            $table->foreignId('id_quan_huyen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuong_xas');
    }
};
