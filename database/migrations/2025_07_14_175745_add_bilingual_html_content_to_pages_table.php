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
            // Add separate HTML content fields for each language
            $table->longText('html_content_en')->nullable()->after('html_content');
            $table->longText('html_content_ar')->nullable()->after('html_content_en');

            // Migrate existing html_content to html_content_en for backward compatibility
            // This will be handled in a separate data migration step
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['html_content_en', 'html_content_ar']);
        });
    }
};
