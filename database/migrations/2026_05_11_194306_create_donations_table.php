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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->constrained('donation_projects')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->boolean('anonymous_flag')->default(false);
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_status', 20)->default('pending');
            $table->string('transaction_ref', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
