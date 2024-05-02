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
        Schema::create('assessment_session_problem_sets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['standard', 'instructor_defined', 'peer_defined']);
            $table->uuid('session_id');
            $table->uuid('set_id');
            $table->uuid('created_by')->nullable();
            $table->timestamps();
            
            $table->foreign('session_id')->references('id')->on('exercise_sessions')->onDelete('cascade');
            $table->foreign('set_id')->references('id')->on('session_problem_sets')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_session_problem_sets');
    }
};
