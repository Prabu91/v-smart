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
        Schema::create('extubations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->date('extubation_datetime')->nullable();
            $table->string('preparation_extubation_theraphy')->nullable();
            $table->string('extubation')->nullable();
            $table->float('nebu_adrenalin')->nullable();
            $table->float('dexamethasone')->nullable();  
            $table->enum('patient_status', ['Meninggal', 'Tidak Meninggal']);
            
            $table->timestamps();
            // Foreign keys
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extubations');
    }
};
