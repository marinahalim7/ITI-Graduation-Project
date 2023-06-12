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
        Schema::create('store_rel_drugs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')
                  ->references('id')
                  ->on("stores")
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->unsignedBigInteger('drug_id');
            $table->foreign('drug_id')
                  ->references('id')
                  ->on("store_drugs")
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_rel_drugs');
    }
};
