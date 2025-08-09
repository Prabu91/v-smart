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
        Schema::table('transfer_rooms', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('lab_culture_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_rooms', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
