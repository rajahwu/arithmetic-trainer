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
        Schema::create('problems', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('problem_level_id');
            $table->uuid('problem_branch_id');
            $table->uuid('problem_type_id');
            $table->text('text');
            $table->text('solution');
            $table->text('explanation')->nullable();
            $table->text('references')->nullable();
            $table->timestamps();

            $table->foreign('problem_level_id')->references('id')->on('problem_levels')->onDelete('cascade');
            $table->foreign('problem_branch_id')->references('id')->on('problem_branches')->onDelete('cascade');
            $table->foreign('problem_type_id')->references('id')->on('problem_types')->onDelete('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
