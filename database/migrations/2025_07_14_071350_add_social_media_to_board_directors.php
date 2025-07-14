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
        Schema::table('board_directors', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('board_directors', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable();
            }
            if (!Schema::hasColumn('board_directors', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('board_directors', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('board_directors', 'twitter_url')) {
                $table->string('twitter_url')->nullable();
            }
            if (!Schema::hasColumn('board_directors', 'facebook_url')) {
                $table->string('facebook_url')->nullable();
            }
            if (!Schema::hasColumn('board_directors', 'instagram_url')) {
                $table->string('instagram_url')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_directors', function (Blueprint $table) {
            $table->dropColumn([
                'linkedin_url',
                'email',
                'phone',
                'twitter_url',
                'facebook_url',
                'instagram_url'
            ]);
        });
    }
};
