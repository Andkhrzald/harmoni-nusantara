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
        Schema::create('religious_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('religion_id')->constrained('religion_categories')->cascadeOnDelete();
            $table->string('type', 30); // worship_place, figure, historical_site
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image_url', 500)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('reference_url', 500)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('religious_highlights');
    }
};
