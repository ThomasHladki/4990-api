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
        Schema::create('residency_positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status');
            $table->text('description');
            $table->string('medical_discipline');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('medical_institution_id');
            $table->foreign('medical_institution_id')->references('id')->on('medical_institutions');
            $table->float('grade_avg_requirement')->nullable();
            $table->boolean('letter_of_reccomendation_req');
            $table->boolean('research_focused');
            $table->boolean('prefers_new_grads');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residency_positions');
    }
};
