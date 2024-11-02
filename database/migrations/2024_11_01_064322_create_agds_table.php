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
        Schema::create('agds', function (Blueprint $table) {
            $table->id();
            $table->float('ph')->nullable;
            $table->float('po2')->nullable;
            $table->float('pco2')->nullable;
            $table->float('spo2')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agds');
    }
};
