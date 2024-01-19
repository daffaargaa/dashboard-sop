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
        Schema::create('sop_ms_sosialisasi_slides', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ms_sosialisasi');
            $table->string('slides');
            $table->string('text_to_voice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_ms_sosialisasi_slides');
    }
};
