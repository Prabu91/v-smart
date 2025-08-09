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
        Schema::table('extubations', function (Blueprint $table) {
            $table->text('extubation_notes')->nullable()->after('patient_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extubations', function (Blueprint $table) {
            $table->dropColumn('extubation_notes');
        });
    }
};
