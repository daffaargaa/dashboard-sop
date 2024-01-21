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
        Schema::create('sop_knowledge', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sosialisasi');
            $table->string('nra');
            $table->string('judul');
            $table->date('tgl_efektif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_knowledge');
    }
};
