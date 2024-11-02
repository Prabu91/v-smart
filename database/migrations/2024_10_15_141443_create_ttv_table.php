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
        Schema::create('ttv', function (Blueprint $table) {
            $table->id(); 
            $table->float('td')->nullable(); 
            $table->float('saturasi')->nullable(); 
            $table->float('nadi')->nullable(); 
            $table->float('rr')->nullable(); 
            $table->float('spo2')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttv');
    }
};
