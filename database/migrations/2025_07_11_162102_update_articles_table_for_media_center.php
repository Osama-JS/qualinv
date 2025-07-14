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
        Schema::table('articles', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn(['type']);

            // Add new columns for media center
            $table->string('category')->default('news')->after('featured_image');
            $table->json('tags')->nullable()->after('category');
            $table->json('meta_title')->nullable()->after('tags');
            $table->json('meta_description')->nullable()->after('meta_title');
            $table->json('meta_keywords')->nullable()->after('meta_description');
            $table->unsignedInteger('views_count')->default(0)->after('meta_keywords');
            $table->boolean('is_featured')->default(false)->after('views_count');

            // Update existing columns
            $table->dropColumn(['meta_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Restore old columns
            $table->string('type')->default('news')->after('featured_image');
            $table->json('meta_data')->nullable()->after('author_id');

            // Remove new columns
            $table->dropColumn([
                'category',
                'tags',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'views_count',
                'is_featured'
            ]);
        });
    }
};
