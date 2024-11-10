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
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');

            $table->integer('sistolik')->nullable(); 
            $table->integer('diastolik')->nullable(); 
            $table->float('suhu')->nullable(); 
            $table->integer('nadi')->nullable(); 
            $table->integer('rr')->nullable(); 
            $table->float('spo2')->nullable(); 
            $table->timestamps(); 
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
