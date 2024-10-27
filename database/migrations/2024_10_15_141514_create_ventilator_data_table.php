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
        Schema::create('ventilator_data', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('observation_id'); // Foreign Key ke tabel observations
            $table->unsignedBigInteger('ttv_id'); // Foreign Key ke tabel observations
        
            // Data ventilator
            $table->string('therapy_type')->nullable(); // Mode ventilasi
            $table->enum('room_type', ['origin', 'icu/picu', 'transfer'])->nullable(); 
            $table->integer('change_day')->nullable(); // Mode ventilasi
            $table->string('mode_venti')->nullable(); // Mode ventilasi
            $table->string('ett_depth')->nullable(); // ETT/Kedalaman
            $table->float('ipl')->nullable(); // IPL
            $table->float('peep')->nullable(); // PEEP
            $table->float('fio2')->nullable(); // FiO2
            $table->float('rr')->nullable(); // Respiratory Rate
            $table->timestamps(); // Created at & updated at
        
            // Foreign key relasi
            $table->foreign('observation_id')->references('id')->on('observations')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventilator_data');
    }
};
