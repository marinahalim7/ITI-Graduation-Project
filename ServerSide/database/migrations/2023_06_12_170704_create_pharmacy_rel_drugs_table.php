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
        Schema::create('pharmacy_rel_drugs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id')
                  ->references('id')
                  ->on("pharmacies")
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->unsignedBigInteger('drug_id');
            $table->foreign('drug_id')
                  ->references('id')
                  ->on("pharmacy_drugs")
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
        Schema::dropIfExists('pharmacy_rel_drugs');
    }
};
