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
        Schema::table('icu_rooms', function (Blueprint $table) {
            $table->text('lab_tests_sent')->nullable()->after('blood_culture');
            $table->string('sputum_color')->nullable()->after('lab_tests_sent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('icu_rooms', function (Blueprint $table) {
            $table->dropColumn('lab_tests_sent');
            $table->dropColumn('sputum_color');
        });
    }
};
