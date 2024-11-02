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
            $table->string('intubation_location')->nullable();
            $table->string('dr_intubation')->nullable();
            $table->string('dr_consultant')->nullable();
            $table->string('therapy_type')->nullable();
            $table->string('mode_venti')->nullable();
            $table->string('ett_depth')->nullable();
            $table->float('ipl')->nullable();
            $table->float('peep')->nullable();
            $table->float('fio2')->nullable();
            $table->float('rr')->nullable();
            $table->timestamps();
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
