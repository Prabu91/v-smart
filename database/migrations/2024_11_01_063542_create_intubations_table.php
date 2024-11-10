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
        Schema::create('intubations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('ttv_id');
            $table->timestamp('intubation_datetime')->nullable();
            $table->string('intubation_location')->nullable();
            $table->integer('change_mode_day')->nullable();
            $table->string('dr_intubation')->nullable();
            $table->string('dr_consultant')->nullable();
            $table->string('therapy_type')->nullable();
            $table->string('mode_venti')->nullable();
            $table->float('diameter', 4, 1)->nullable();
            $table->float('depth', 5, 1)->nullable();
            $table->decimal('ipl')->nullable();
            $table->decimal('peep')->nullable();
            $table->decimal('fio2')->nullable();
            $table->integer('rr')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intubations');
    }
};
