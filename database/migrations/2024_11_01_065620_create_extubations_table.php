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
            $table->date('icu_room_date')->nullable();
            $table->string('preparation_extubation_theraphy')->nullable();
            $table->string('extubation')->nullable();
            $table->float('nebu_adrenalin')->nullable();
            $table->float('dexamethasone')->nullable();
            $table->string('main_diagnose')->nullable();
            $table->string('secondary_diagnose')->nullable();    
            $table->unsignedBigInteger('agd_id')->nullable();
            $table->unsignedBigInteger('ttv_id')->nullable();    
            
            $table->timestamps();
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
