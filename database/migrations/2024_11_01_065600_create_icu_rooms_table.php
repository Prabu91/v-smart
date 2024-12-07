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
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('user_id');

            $table->timestamp('icu_room_datetime')->nullable();
            $table->integer('icu_room_bednum')->nullable();
            $table->string('icu_room_name')->nullable();

            $table->string('ro')->nullable();
            $table->string('ro_post_intubation')->nullable();
            $table->string('blood_culture')->nullable();

            $table->uuid('ttv_id')->nullable();
            $table->uuid('elektrolit_id')->nullable();
            $table->uuid('labresult_id')->nullable();
            $table->uuid('ventilator_id')->nullable();
            $table->uuid('agd_id')->nullable();  
            $table->timestamps();
            // Foreign keys

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');
            $table->foreign('elektrolit_id')->references('id')->on('elektrolits')->onDelete('cascade');
            $table->foreign('labresult_id')->references('id')->on('lab_results')->onDelete('cascade');
            $table->foreign('ventilator_id')->references('id')->on('ventilators')->onDelete('cascade');
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
