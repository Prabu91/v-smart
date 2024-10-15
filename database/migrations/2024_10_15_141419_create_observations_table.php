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
        Schema::create('observations', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('patient_id'); // Foreign Key ke tabel patients
            $table->unsignedBigInteger('user_id'); // Foreign Key ke tabel users (yang mengisi observasi)
            
            // Bagian Asal Ruangan
            $table->date('origin_room_date')->nullable(); // Tanggal masuk dari ruangan asal
        
            // Bagian ICU/PICU
            $table->date('icu_room_date')->nullable(); // Tanggal masuk ICU/PICU
        
            // Bagian Pindah Ruangan
            $table->date('transfer_room_date')->nullable(); // Tanggal pindah ke ruangan lain
        
            $table->timestamps(); // Created at & updated at
        
            // Foreign key relasi
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
