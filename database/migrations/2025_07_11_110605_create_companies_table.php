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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // {'en': 'Quality Investment Company', 'ar': 'جودة الإستثمار'}
            $table->json('about')->nullable(); // About us content in both languages
            $table->json('mission')->nullable(); // Mission statement
            $table->json('vision')->nullable(); // Vision statement
            $table->json('values')->nullable(); // Company values
            $table->string('logo')->nullable(); // Company logo path
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable(); // Social media links
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
