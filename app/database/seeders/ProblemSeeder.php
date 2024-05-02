<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Problem;
use App\Models\Category;
use App\Models\ProblemCategory;
use DateTime;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or retrieve the "core" category
        $coreCategory = Category::firstOrCreate(['title' => 'core']);

        // Create or retrieve the "arithmetic" category
        $arithmeticCategory = Category::firstOrCreate(['title' => 'arithmetic']);

        // Create categories for addition, subtraction, multiplication, and division
        $additionCategory = Category::firstOrCreate(['title' => 'addition']);
        $subtractionCategory = Category::firstOrCreate(['title' => 'subtraction']);
        $multiplicationCategory = Category::firstOrCreate(['title' => 'multiplication']);
        $divisionCategory = Category::firstOrCreate(['title' => 'division']);

        // Addition problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $solution = $i + $j;
                $text = "$i + $j";

                // Create the problem
                $problem = Problem::create([
                    'id' => Str::uuid(),
                    'text' => $text,
                    'solution' => $solution,
                    'created_at' => new DateTime(),
                ]);

                // Assign the problem to categories
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $coreCategory->id,
                ]);
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $arithmeticCategory->id,
                ]);
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $additionCategory->id,
                ]);
            }
        }

        // Subtraction problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                if (($i - $j) > 0) {
                    $solution = $i - $j;
                    $text = "$i - $j";

                    // Create the problem
                    $problem = Problem::create([
                        'id' => Str::uuid(),
                        'text' => $text,
                        'solution' => $solution,
                        'created_at' => new DateTime(),
                    ]);

                    // Assign the problem to categories
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $coreCategory->id,
                    ]);
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $arithmeticCategory->id,
                    ]);
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $subtractionCategory->id,
                    ]);
                }
            }
        }

        // Multiplication problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $solution = $i * $j;
                $text = "$i * $j";

                // Create the problem
                $problem = Problem::create([
                    'id' => Str::uuid(),
                    'text' => $text,
                    'solution' => $solution,
                    'created_at' => new DateTime(),
                ]);

                // Assign the problem to categories
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $coreCategory->id,
                ]);
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $arithmeticCategory->id,
                ]);
                ProblemCategory::create([
                    'problem_id' => $problem->id,
                    'category_id' => $multiplicationCategory->id,
                ]);
            }
        }

        // Division problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                if ($i > $j && $i % $j == 0) {
                    $solution = $i / $j;
                    $text = "$i / $j";

                    // Create the problem
                    $problem = Problem::create([
                        'id' => Str::uuid(),
                        'text' => $text,
                        'solution' => $solution,
                        'created_at' => new DateTime(),
                    ]);

                    // Assign the problem to categories
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $coreCategory->id,
                    ]);
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $arithmeticCategory->id,
                    ]);
                    ProblemCategory::create([
                        'problem_id' => $problem->id,
                        'category_id' => $divisionCategory->id,
                    ]);
                }
            }
        }
   
    }
}