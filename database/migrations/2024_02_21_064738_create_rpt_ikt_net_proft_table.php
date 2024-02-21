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
        Schema::create('rpt_ikt_net_profit', function (Blueprint $table) {
            $table->string('inp_store_code', 4)->nullable();
            $table->date('inp_date')->nullable();
            $table->decimal('inp_net_sales_budget', 16,2)->nullable();
            $table->decimal('inp_net_sales_opr', 16,2)->nullable();
            $table->decimal('inp_net_profit_budget', 16,2)->nullable();
            $table->decimal('inp_net_profit_opr', 16,2)->nullable();
            $table->decimal('inp_gm_budget', 16,2)->nullable();
            $table->decimal('inp_gm_pct_budget', 5, 4)->nullable();
            $table->decimal('inp_shrinkage_budget', 16,2)->nullable();
            $table->decimal('inp_nbh_budget', 16,2)->nullable();
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpt_ikt_net_proft');
    }
};
