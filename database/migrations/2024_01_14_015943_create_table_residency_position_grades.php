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
        Schema::create('residency_position_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('residency_position_id');
            $table->foreign('residency_position_id')->references('id')->on('residency_positions');
            $table->string('course_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residency_position_grades');
    }
};
