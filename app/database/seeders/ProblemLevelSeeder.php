<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemLevel;

class ProblemLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProblemLevel::create(['title' => 'core']);
        ProblemLevel::create(['title' => 'advanced']);
        ProblemLevel::create(['title' => 'expert']);
        ProblemLevel::create(['title' => 'mastery']);
    }
}
