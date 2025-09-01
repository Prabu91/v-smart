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
            $table->text('venti_param')->nullable()->after('trigger');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventilators', function (Blueprint $table) {
            $table->dropColumn('venti_param');
        });
    }
};
