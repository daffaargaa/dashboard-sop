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
        Schema::create('tmp_target_ikt_store', function (Blueprint $table) {
            $table->string('kd_store', 4)->nullable();
            $table->date('tgl_target')->nullable();
            $table->decimal('net_sales', 16, 2)->nullable();
            $table->decimal('net_profit', 16, 2)->nullable();
            $table->decimal('rp_margin', 16, 2)->nullable();
            $table->decimal('pct_margin', 5, 4)->nullable();
            $table->decimal('rp_musnah', 16, 2)->nullable();
            $table->decimal('rp_product_loss', 16, 2)->nullable();
            $table->date('tgl_proses')->nullable();
            $table->string('user_id', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_target_ikt_store');
    }
};
