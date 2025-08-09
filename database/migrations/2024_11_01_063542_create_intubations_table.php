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
            $table->uuid('id')->primary(); 
            $table->uuid('patient_id');
            $table->uuid('user_id');
            $table->uuid('ventilator_id')->nullable();
            $table->uuid('ttv_pre_id');
            $table->uuid('ttv_post_id');

            
            $table->timestamp('intubation_datetime')->nullable();
            $table->string('intubation_location')->nullable();
            $table->string('dr_intubation')->nullable();
            $table->string('dr_consultant')->nullable();
            
            $table->text('pre_intubation')->nullable();
            $table->text('post_intubation')->nullable();
            $table->float('ett_diameter', 4, 1)->nullable();
            $table->float('ett_depth', 5, 1)->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('ttv_pre_id')->references('id')->on('ttv')->onDelete('no action');
            $table->foreign('ttv_post_id')->references('id')->on('ttv')->onDelete('no action');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('ventilator_id')->references('id')->on('ventilators')->onDelete('no action');

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
