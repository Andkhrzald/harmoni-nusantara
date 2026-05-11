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
        Schema::create('donation_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->text('description');
            $table->decimal('target_amount', 15, 2);
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->string('religion_scope', 20)->default('all');
            $table->string('cover_image', 500)->nullable();
            $table->string('status', 20)->default('active');
            $table->date('deadline')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_projects');
    }
};
