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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Post title in both languages
            $table->json('slug'); // URL-friendly slug in both languages
            $table->json('excerpt')->nullable(); // Short description
            $table->json('content'); // Full post content
            $table->string('featured_image')->nullable(); // Featured image
            $table->enum('type', ['news', 'blog'])->default('news'); // Post type
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->json('meta_data')->nullable(); // SEO and other metadata
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
