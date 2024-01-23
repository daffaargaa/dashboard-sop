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
        Schema::create('sop_ms_sosialisasi_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ms_sosialisasi');
            $table->string('pertanyaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_ms_sosialisasi_pertanyaan');
    }
};
