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
        Schema::create('pharmacy_drugs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("img");
            $table->float("price");
            $table->integer("quantity");
            
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id')
                  ->references('id')
                  ->on("pharmacies")
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
        Schema::dropIfExists('pharmacy_drugs');
    }
};
