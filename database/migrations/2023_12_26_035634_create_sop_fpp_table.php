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
        Schema::create('sop_fpp', function (Blueprint $table) {
            $table->id();
            $table->string('no_form', 255);
            $table->string('nama', 100);
            $table->string('inisial', 3);
            $table->string('dept', 100);
            $table->string('tipe_pengajuan', 100);
            $table->string('status', 1);
            $table->string('user_id', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_fpp');
    }
};
