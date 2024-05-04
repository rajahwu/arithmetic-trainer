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
            $table->foreginId('problem_level_id')->constrianted();
            $table->foreginId('problem_branch_id')->constrianted();
            $table->foreginId('problem_type_id')->constrianted();
            $table->text('text');
            $table->text('solution');
            $table->text('explanation')->nullable();
            $table->text('references')->nullable();
            $table->timestamps();
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
