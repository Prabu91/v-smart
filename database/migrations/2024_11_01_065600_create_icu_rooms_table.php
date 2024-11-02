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
            $table->date('icu_room_date')->nullable();
            $table->string('icu_room_name')->nullable();
            $table->string('ro')->nullable();
            $table->string('ro_post_intubation')->nullable();
            $table->string('blood_culture')->nullable();
            $table->unsignedBigInteger('labresult_id')->nullable();
            $table->unsignedBigInteger('intubation_id')->nullable();
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
        Schema::dropIfExists('icu_rooms');
    }
};
