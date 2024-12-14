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
        Schema::create('ventilators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('user_id');

            $table->timestamp('venti_datetime')->nullable();
            $table->timestamp('venti_usagetime')->nullable();
            $table->string('mode_venti')->nullable();
            $table->decimal('ipl')->nullable();
            $table->decimal('peep')->nullable();
            $table->decimal('fio2')->nullable();
            $table->integer('rr')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventilators');
    }
};
