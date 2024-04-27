<?php

namespace Database\Seeders;

use App\Models\Problem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use DateTime;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {

                $solution = $i + $j;
                $text = "$i + $j";

                Problem::create([
                    'id' => Uuid::uuid4(),
                    'text' => $text,
                    'solution' => $solution,
                    'category' => 'core,arithmitic,addition',
                    'created_at' => new DateTime(),
                ]);
            }
        }
    }
}
