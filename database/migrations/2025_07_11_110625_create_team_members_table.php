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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Member name in both languages
            $table->json('position'); // Position/title in both languages
            $table->json('bio')->nullable(); // Biography in both languages
            $table->string('photo')->nullable(); // Member photo
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->json('social_media')->nullable(); // Social media links
            $table->integer('sort_order')->default(0); // For ordering team members
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
