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
        Schema::create('sop_sosialisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ms_sosialisasi');
            $table->string('nra');
            $table->string('judul');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('re_attempt_test');
            $table->integer('limit_waktu_test');
            $table->integer('batas_nilai');
            $table->string('status');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_sosialisasi');
    }
};
