<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemBranch;

class ProblemBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProblemBranch::create(['title' => 'arithmetic']);
        ProblemBranch::create(['title' => 'number theory']);
        ProblemBranch::create(['title' => 'geometry']);
        ProblemBranch::create(['title' => 'algebra']);
    }
}
