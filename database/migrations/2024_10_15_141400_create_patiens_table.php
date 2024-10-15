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
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama pasien
            $table->string('no_cm'); // Nomor catatan medis (CM)
            $table->date('date_of_birth'); // Tanggal lahir pasien
            $table->enum('gender', ['male', 'female']); // Jenis kelamin pasien
            $table->timestamps(); // Created at & updated at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patiens');
    }
};
