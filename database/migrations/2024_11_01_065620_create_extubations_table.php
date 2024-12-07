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
        Schema::create('extubations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');            
            $table->uuid('user_id');
            $table->uuid('ttv_id')->nullable();

            $table->timestamp('extubation_datetime')->nullable();
            $table->text('preparation_extubation_therapy')->nullable();
            $table->string('extubation')->nullable();
            $table->text('nebulizer')->nullable();
            $table->enum('patient_status', ['Meninggal', 'Tidak Meninggal']);
            $table->timestamps();
            // Foreign keys
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ttv_id')->references('id')->on('ttv')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extubations');
    }
};
