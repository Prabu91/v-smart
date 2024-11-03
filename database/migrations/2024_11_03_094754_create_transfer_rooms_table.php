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
            $table->date('transfer_room_datetime')->nullable();
            $table->string('transfer_room_name')->nullable();
            $table->string('main_diagnose')->nullable();
            $table->string('secondary_diagnose')->nullable();
            $table->unsignedBigInteger('labresult_id')->nullable();
            $table->unsignedBigInteger('agd_id')->nullable();
            $table->unsignedBigInteger('ttv_id')->nullable();
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
        Schema::dropIfExists('transfer_rooms');
    }
};
