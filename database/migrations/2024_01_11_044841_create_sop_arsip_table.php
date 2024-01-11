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
        Schema::create('sop_arsip', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dept');
            $table->integer('id_jenis_arsip');
            $table->integer('id_produk');
            $table->string('nra');
            $table->string('judul');
            $table->string('keterangan');
            $table->string('tgl_release');
            $table->string('file')->nullable();
            $table->string('flag_opr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop_arsip');
    }
};
