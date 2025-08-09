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
        Schema::table('intubations', function (Blueprint $table) {
            $table->enum('intubation_type', ['ETT', 'TC'])->after('ett_depth');
            $table->float('tc_diameter', 4, 1)->nullable()->after('intubation_type');
            $table->string('tc_type')->nullable()->after('tc_diameter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intubations', function (Blueprint $table) {
            $table->dropColumn('intubation_type');
            $table->dropColumn('tc_diameter');
            $table->dropColumn('tc_type');
        });
    }
};
