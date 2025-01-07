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
        Schema::table('thue_sans', function (Blueprint $table) {
            $table->integer('thanh_toan')->default(0)->comment('0: Chưa thanh toán, 1: Đã cọc, 2: Đã thanh toán');
            $table->double('so_tien_coc')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thue_sans', function (Blueprint $table) {
            //
        });
    }
};
