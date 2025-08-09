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
        Schema::table('ventilators', function (Blueprint $table) {
            $table->float('ps', 4, 1)->nullable()->after('rr');
            $table->float('trigger', 4, 1)->nullable()->after('ps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventilators', function (Blueprint $table) {
            $table->dropColumn('ps');
            $table->dropColumn('trigger');
        });
    }
};
