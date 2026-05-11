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
        Schema::create('education_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('religion_id')->constrained('religion_categories')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('title', 500);
            $table->string('slug', 500)->unique();
            $table->text('content');
            $table->string('content_type', 20);
            $table->string('youtube_video_id', 50)->nullable();
            $table->string('thumbnail_url', 500)->nullable();
            $table->string('status', 20)->default('pending');
            $table->string('age_group', 20)->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_contents');
    }
};
