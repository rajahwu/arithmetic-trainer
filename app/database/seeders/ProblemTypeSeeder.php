<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemType;

class ProblemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProblemType::create(['title' => 'addition']);
        ProblemType::create(['title' => 'subtraction']);
        ProblemType::create(['title' => 'multiplication']);
        ProblemType::create(['title' => 'division']);
    }
}
