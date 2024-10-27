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
            $table->id(); // Primary Key
            $table->unsignedBigInteger('observation_id'); // Foreign Key ke tabel observations
        
            // Data hasil laboratorium
            $table->float('hb')->nullable(); // Hemoglobin
            $table->float('leukosit')->nullable(); // Leukosit
            $table->float('pcv')->nullable(); // Packed Cell Volume
            $table->float('trombosit')->nullable(); // Trombosit
            $table->enum('room_type', ['origin', 'icu/picu', 'transfer'])->nullable(); // RO Thorax sudah/belum
            $table->float('ph')->nullable(); // Analisis Gas Darah
            $table->float('pco2')->nullable(); // Analisis Gas Darah
            $table->float('po2')->nullable(); // Analisis Gas Darah
            $table->string('radiology')->nullable(); // Hasil radiologi (misal RO Thorax)
            $table->string('ro_thorax')->nullable(); // RO Thorax sudah/belum
            $table->timestamps(); // Created at & updated at
        
            // Foreign key relasi
            $table->foreign('observation_id')->references('id')->on('observations')->onDelete('cascade');
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