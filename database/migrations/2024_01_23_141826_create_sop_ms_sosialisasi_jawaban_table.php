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
        Schema::create('sop_ms_sosialisasi_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pertanyaan');
            $table->string('jawaban');
            $table->string('jawaban_benar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_ms_sosialisasi_jawaban');
    }
};
