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
        Schema::create('sop_sosialisasi_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sosialisasi');
            $table->string('nik_peserta');
            $table->string('kode_toko');
            $table->string('status_lulus');
            $table->integer('nilai')->nullable();
            $table->string('is_expired');
            $table->string('is_done')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_sosialisasi_user');
    }
};
