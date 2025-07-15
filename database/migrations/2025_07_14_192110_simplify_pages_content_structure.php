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
        Schema::table('pages', function (Blueprint $table) {
            // Add simple content fields for Arabic and English
            $table->longText('content_ar')->nullable()->after('description');
            $table->longText('content_en')->nullable()->after('content_ar');

            // Remove the complex HTML/CSS/JS fields that are not user-friendly
            $table->dropColumn(['html_content', 'html_content_en', 'html_content_ar', 'css_styling', 'js_functionality']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Restore the old complex fields
            $table->longText('html_content')->nullable();
            $table->longText('html_content_en')->nullable();
            $table->longText('html_content_ar')->nullable();
            $table->longText('css_styling')->nullable();
            $table->longText('js_functionality')->nullable();

            // Remove the simple content fields
            $table->dropColumn(['content_ar', 'content_en']);
        });
    }
};
