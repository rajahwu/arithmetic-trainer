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
        Schema::create('exercise_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->foreignId('user_id')->constrained();
            $table->enum('type', ['practice', 'assessment']);
            $table->foreignId('practice_session_problem_set_id')
                  ->constrained()
                  ->nullable();
            $table->foreginId('assessment_id')
                  ->constrained()
                  ->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('start_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_time')->nullable();
            $table->boolean('is_completed')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_sessions');
    }
};
