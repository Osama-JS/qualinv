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
        Schema::table('investment_applications', function (Blueprint $table) {
            $table->enum('share_type', ['regular', 'redeemable'])
                  ->default('regular')
                  ->after('number_of_shares')
                  ->comment('نوع السهم: عادي أو مسترد');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investment_applications', function (Blueprint $table) {
            $table->dropColumn('share_type');
        });
    }
};
