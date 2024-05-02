<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'core'
        ]);

        Category::create([
            'title' => 'arithmetic'
        ]);

        Category::create([
            'title' => 'addition'
        ]);

        Category::create([
            'title' => 'subtraction'
        ]);

        Category::create([
            'title' => 'multiplication'
        ]);
        
        Category::create([
            'title' => 'division'
        ]);
    }
}
