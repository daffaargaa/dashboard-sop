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
        Schema::create('sop_approval_draft_user', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('id_draft');
            $table->string('nik');
            $table->string('approve_user', 1);
            $table->integer('urutan');
            $table->string('halaman');
            $table->string('jenis_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_approval_draft_user');
    }
};
