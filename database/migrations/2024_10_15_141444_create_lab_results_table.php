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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('patient_id');
            $table->float('hb')->nullable(); 
            $table->float('leukosit')->nullable(); 
            $table->float('pcv')->nullable();
            $table->float('trombosit')->nullable(); 
            $table->float('kreatinin')->nullable(); 
            $table->timestamps(); 
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
