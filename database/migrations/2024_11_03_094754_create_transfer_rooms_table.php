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
            $table->id();

            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamp('transfer_room_datetime')->nullable();
            $table->string('transfer_room_name')->nullable();
            $table->string('main_diagnose')->nullable();
            $table->string('secondary_diagnose')->nullable();
            $table->string('lab_culture_data')->nullable();
            $table->unsignedBigInteger('labresult_id')->nullable();
            $table->unsignedBigInteger('ttv_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('labresult_id')->references('id')->on('lab_results')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');        
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
