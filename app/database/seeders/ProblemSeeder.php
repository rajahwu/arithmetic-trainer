<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Problem;
use DateTime;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Addition problems
          for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $solution = $i + $j;
                $text = "$i + $j";

                Problem::create([
                    'id' => Str::uuid(),
                    'text' => $text,
                    'solution' => $solution,
                    'category_id' => Str::uuid()(),
                    'created_at' => new DateTime(),
                ]);
            }
        }

        // Multiplication problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $solution = $i * $j;
                $text = "$i * $j";

                Problem::create([
                    'id' => Str::uuid(),
                    'text' => $text,
                    'solution' => $solution,
                    'created_at' => new DateTime(),
                ]);
            }
        }
        
        // Subtraction problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                if (($i - $j) > 0) {
                    $solution = $i - $j;
                    $text = "$i - $j";
                    
                    Problem::create([
                        'id' => Str::uuid(),
                        'text' => $text,
                        'solution' => $solution,
                        'created_at' => new DateTime(),
                    ]);
                }
            }
        }

        // Division problems
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                if ($i > $j && $i % $j == 0) {
                    $solution = $i / $j;
                    $text = "$i / $j";
                    
                    ProblemSet::create([
                        'id' => Str::uuid(),
                        'text' => $text,
                        'solution' => $solution,
                        'created_at' => new DateTime(),
                    ]);
                }
            }
        }
    }
}
