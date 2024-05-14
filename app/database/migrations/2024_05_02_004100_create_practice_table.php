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
        Schema::create('practices', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->enum('type', ['standard', 'instructor_defined', 'peer_defined']);
            $table->string('title');
            $table->text('description');
            $table->foreignId('created_by')->constrained(table: 'users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practices');
        
    }
};
