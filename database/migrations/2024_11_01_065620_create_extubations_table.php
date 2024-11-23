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

            $table->timestamp('extubation_datetime')->nullable();
            $table->string('preparation_extubation_therapy')->nullable();
            $table->string('extubation')->nullable();
            $table->decimal('nebu_adrenalin')->nullable();
            $table->decimal('dexamethasone')->nullable();  
            $table->enum('patient_status', ['Meninggal', 'Tidak Meninggal']);
            $table->timestamps();
            // Foreign keys
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
