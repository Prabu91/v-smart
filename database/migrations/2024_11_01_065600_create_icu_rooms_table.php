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
        Schema::create('icu_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->timestamp('icu_room_datetime')->nullable();
            $table->string('icu_room_name')->nullable();
            $table->string('ro')->nullable();
            $table->string('ro_post_intubation')->nullable();
            $table->string('blood_culture')->nullable();
            $table->unsignedBigInteger('labresult_id')->nullable();
            $table->unsignedBigInteger('intubation_id')->nullable();
            $table->unsignedBigInteger('agd_id')->nullable();  
            $table->timestamps();
            // Foreign keys
        $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        $table->foreign('labresult_id')->references('id')->on('lab_results')->onDelete('cascade');
        $table->foreign('intubation_id')->references('id')->on('intubations')->onDelete('cascade');
        $table->foreign('agd_id')->references('id')->on('agds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icu_rooms');
    }
};
