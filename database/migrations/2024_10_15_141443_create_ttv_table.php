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
        Schema::create('ttv', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('observation_id'); // Foreign Key ke tabel observations

            // Data tanda-tanda vital
            $table->float('td')->nullable(); // Tekanan darah (mmHg)
            $table->float('saturasi')->nullable(); // Saturasi oksigen (%)
            $table->float('nadi')->nullable(); // Denyut nadi (bpm)
            $table->float('rr')->nullable(); // Frekuensi napas (bpm)
            $table->float('spo2')->nullable(); // SpO2 level (%)
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
        Schema::dropIfExists('ttv');
    }
};
