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
        Schema::create('therapies', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('observation_id'); // Foreign Key ke tabel observations
        
            // Data terapi
            $table->text('therapy_type')->nullable(); // Tipe terapi yang diberikan
            $table->text('preparation_extubation_therapy')->nullable(); // Terapi persiapan extubasi
            $table->boolean('nebu_adrenalin')->nullable(); // Nebu adrenalin (Ya/Tidak)
            $table->boolean('dexamethasone')->nullable(); // Dexamethasone (Ya/Tidak)
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
        Schema::dropIfExists('therapies');
    }
};
