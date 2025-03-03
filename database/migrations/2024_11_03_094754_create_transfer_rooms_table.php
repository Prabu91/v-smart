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
        Schema::create('transfer_rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('user_id');

            $table->timestamp('transfer_room_datetime')->nullable();
            $table->string('transfer_room_name')->nullable();
            $table->string('main_diagnose')->nullable();
            $table->string('secondary_diagnose')->nullable();
            $table->string('lab_culture_data')->nullable();
            $table->uuid('labresult_id')->nullable();
            $table->uuid('ttv_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('labresult_id')->references('id')->on('lab_results')->onDelete('no action');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('no action');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_rooms');
    }
};
