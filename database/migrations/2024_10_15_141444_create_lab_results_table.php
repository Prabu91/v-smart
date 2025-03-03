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
            $table->uuid('id')->primary(); 
            $table->uuid('patient_id');
            $table->uuid('user_id');

            $table->decimal('hb')->nullable(); 
            $table->integer('leukosit')->nullable(); 
            $table->float('pcv')->nullable();
            $table->integer('trombosit')->nullable(); 
            $table->decimal('kreatinin')->nullable(); 
            $table->float('albumin')->nullable();
            $table->float('laktat')->nullable();
            $table->float('sbut')->nullable();
            $table->float('ureum')->nullable();
            
            $table->timestamps(); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
