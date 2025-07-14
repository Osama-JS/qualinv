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
        Schema::create('investment_applications', function (Blueprint $table) {
            $table->id();

            // Application metadata
            $table->string('reference_number')->unique();
            $table->enum('applicant_type', ['saudi_individual', 'company_institution']);
            $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->foreignId('read_by')->nullable()->constrained('users')->onDelete('set null');

            // Common fields for both types
            $table->string('nationality');
            $table->string('country_of_residence');
            $table->string('mobile_number');
            $table->string('email');
            $table->integer('number_of_shares');

            // Saudi Individual specific fields
            $table->string('national_id_residence_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('full_name')->nullable();
            $table->string('profession')->nullable();

            // Company/Institution specific fields
            $table->string('commercial_registration_number')->nullable();
            $table->string('name_per_commercial_registration')->nullable();
            $table->string('absher_registered_mobile')->nullable();

            // System tracking fields
            $table->ipAddress('ip_address');
            $table->text('user_agent');
            $table->text('admin_notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('status_changed_at')->nullable();
            $table->foreignId('status_changed_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();

            // Indexes for better performance
            $table->index(['applicant_type', 'status']);
            $table->index(['is_read', 'created_at']);
            $table->index(['status', 'created_at']);
            $table->index('reference_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_applications');
    }
};
