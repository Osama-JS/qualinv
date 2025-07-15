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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Page name in both languages {'en': 'About Us', 'ar': 'من نحن'}
            $table->json('slug'); // URL slug in both languages {'en': 'about-us', 'ar': 'من-نحن'}
            $table->enum('position', ['navbar', 'footer'])->default('navbar'); // Page location
            $table->json('description')->nullable(); // Page description in both languages
            $table->longText('html_content')->nullable(); // HTML content
            $table->longText('css_styling')->nullable(); // CSS styling
            $table->longText('js_functionality')->nullable(); // JavaScript functionality
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0); // For ordering pages
            $table->json('meta_title')->nullable(); // SEO meta title
            $table->json('meta_description')->nullable(); // SEO meta description
            $table->json('meta_keywords')->nullable(); // SEO meta keywords
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['status', 'position']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
