<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('origin_rooms', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('patient_id');
        $table->uuid('user_id');

        $table->string('origin_room_name')->nullable();
        $table->string('physical_check')->nullable();
        $table->text('radiology')->nullable();
        $table->text('additional_check')->nullable();
        $table->string('main_diagnose')->nullable();
        $table->string('secondary_diagnose')->nullable();
        $table->integer('ews')->nullable();
        $table->float('natrium')->nullable();
        $table->float('kalium')->nullable();
        $table->float('gds')->nullable();
        $table->uuid('labresult_id')->nullable();
        $table->uuid('intubation_id')->nullable();
        $table->uuid('agd_id')->nullable();
        $table->timestamps();

        // Foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        $table->foreign('labresult_id')->references('id')->on('lab_results')->onDelete('cascade');
        $table->foreign('intubation_id')->references('id')->on('intubations')->onDelete('cascade');
        $table->foreign('agd_id')->references('id')->on('agds')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('origin_rooms');
    }
};
