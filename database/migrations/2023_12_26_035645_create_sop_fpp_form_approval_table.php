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
        Schema::create('sop_fpp_form_approval', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('id_sop_fpp');
            $table->string('nik', 10);
            $table->string('jenis', 100);
            $table->tinyInteger('urutan');
            $table->string('is_approve', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_fpp_form_approval');
    }
};
