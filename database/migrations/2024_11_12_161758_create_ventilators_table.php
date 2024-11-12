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
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('intubation_id');
            $table->unsignedBigInteger('ttv_id');

            $table->timestamp('venti_datetime')->nullable();
            $table->string('therapy_type')->nullable();
            $table->string('mode_venti')->nullable();
            $table->float('diameter', 4, 1)->nullable();
            $table->float('depth', 5, 1)->nullable();
            $table->decimal('ipl')->nullable();
            $table->decimal('peep')->nullable();
            $table->decimal('fio2')->nullable();
            $table->integer('rr')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('intubation_id')->references('id')->on('intubations')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');
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
