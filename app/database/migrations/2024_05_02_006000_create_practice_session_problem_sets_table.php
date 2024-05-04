<?php

use Illuminate\Support\Str;
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
        Schema::create('practice_session_problem_sets', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('session_id');
            $table->uuid('problem_id');
            $table->timestamps();
            
            $table->foreign('session_id')->references('id')->on('exercise_sessions')->onDelete('cascade');
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_session_problem_sets');
    }
};
