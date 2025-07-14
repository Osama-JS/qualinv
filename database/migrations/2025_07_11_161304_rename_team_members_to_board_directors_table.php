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
        Schema::rename('team_members', 'board_directors');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('board_directors', 'team_members');
    }
};
