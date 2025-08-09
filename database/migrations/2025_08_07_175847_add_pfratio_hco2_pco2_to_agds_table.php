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
        Schema::table('agds', function (Blueprint $table) {
            $table->integer('pf_ratio')->nullable()->after('sbpt');
            $table->integer('hco2')->nullable()->after('pf_ratio');
            $table->integer('tco2')->nullable()->after('hco2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agds', function (Blueprint $table) {
            $table->dropColumn('pf_ratio');
            $table->dropColumn('hco2');
            $table->dropColumn('tco2');
        });
    }
};
