<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Problem;
use App\Models\ProblemLevel;
use App\Models\ProblemBranch;
use App\Models\ProblemType;
use DateTime;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve or create problem levels, branches, and types
        $problemLevel = ProblemLevel::where('title', 'core')->first();
        $problemBranch = ProblemBranch::where('title', 'arithmetic')->first();

        // Addition problems
        $this->seedProblems($problemLevel, $problemBranch, 'addition', '+');

        // Subtraction problems
        $this->seedProblems($problemLevel, $problemBranch, 'subtraction', '-');

        // Multiplication problems
        $this->seedProblems($problemLevel, $problemBranch, 'multiplication', '*');

        // Division problems
        $this->seedDivisionProblems($problemLevel, $problemBranch);
    }

    /**
     * Seed problems of a specific type.
     *
     * @param  \App\Models\ProblemLevel  $level
     * @param  \App\Models\ProblemBranch $branch
     * @param  string $type
     * @param  string $symbol
     * @return void
     */
    private function seedProblems($level, $branch, $type, $symbol): void
    {
        $problemType = ProblemType::where('title', $type)->first();

        for ($i = 1; $i <= 9; $i++) {
            for ($j = $i; $j <= 9; $j++) { // Modified loop condition
                // Determine text and solution based on problem type
                $text = "$i$symbol$j";
                switch ($type) {
                    case 'addition':
                        $solution = $i + $j;
                        break;
                    case 'subtraction':
                        $solution = $i - $j;
                        break;
                    case 'multiplication':
                        $solution = $i * $j;
                        break;
                }

                // Create the problem
                Problem::create([
                    'id' => Str::uuid(),
                    'problem_level_id' => $level->id,
                    'problem_branch_id' => $branch->id,
                    'problem_type_id' => $problemType->id,
                    'text' => $text,
                    'solution' => $solution,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
            }
        }
    }

    /**
     * Seed division problems.
     *
     * @param  \App\Models\ProblemLevel  $level
     * @param  \App\Models\ProblemBranch $branch
     * @return void
     */
    private function seedDivisionProblems($level, $branch): void
    {
        $problemType = ProblemType::where('title', 'division')->first();

        for ($i = 2; $i <= 9; $i++) { // Exclude division by 1
            for ($j = 1; $j < $i; $j++) { // Exclude division with remainder (whole numbers only)
                // Determine text and solution
                $solution = $i / $j;
                $text = "$i/$j";

                // Create the problem
                Problem::create([
                    'id' => Str::uuid(),
                    'problem_level_id' => $level->id,
                    'problem_branch_id' => $branch->id,
                    'problem_type_id' => $problemType->id,
                    'text' => $text,
                    'solution' => $solution,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
            }
        }
    }
}
