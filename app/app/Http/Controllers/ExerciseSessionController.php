<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\ProblemLevel;
use App\Models\ProblemBranch;
use App\Models\ProblemType;
use App\Models\Problem;
use App\Models\Practice;
use App\Models\ExerciseSession;

class ExerciseSessionController extends Controller
{
    private function save() {
        return Redirect::route('dashboard');
    }

    private function cancel() {

    }

    private function reset() {

    }

    public function select() {

        return Inertia::render('Exercise/Select', [
            
        ]);
    }
    
    public function settings(Request $request) {
        $selected = $request->input('selected');
        $exercise_type = $selected['type'];
        $exercise_category = $selected['category'];

        switch ($exercise_type) {
            case 'practice':
                $levels = ProblemLevel::all();
                $branches = ProblemBranch::all();
                $types = ProblemType::all();
                return Inertia::render('Exercise/Practice/Settings', [
                    'settings' => [
                        'exercise_type' => $exercise_type,
                        'exercise_category' => $exercise_category,
                        'problem_levels' => $levels,
                        'problem_branches' => $branches,
                        'problem_types' => $types
                        ]
                ]);
                
            case 'assestment':
                $levels = ProblemLevel::all();
                $branches = ProblemBranch::all();
                $types = ProblemType::all();
                return Inertia::render('Exercise/Assestment/Settings', [
                    'settings' => [
                        'exercise_type' => $exercise_type,
                        'exercise_category' => $exercise_category,
                        'problem_levels' => $levels,
                        'problem_branches' => $branches,
                        'problem_types' => $types
                        ]
                ]);
                    
            case 'standard':
                $levels = ProblemLevel::all();
                $branches = ProblemBranch::all();
                $types = ProblemType::all();
                return Inertia::render('Exercise/Practice/Settings', [
                    'settings' => [
                        'exercise_type' => $exercise_type,
                        'exercise_category' => $exercise_category,
                        'problem_levels' => $levels,
                        'problem_branches' => $branches,
                        'problem_types' => $types
                        ]
                ]);
        }
        return Redirect::route('exercise.select');

    }

    public function create(Request $request) {
        $exercise_type = $request->input('exercise_type');
        $exercise_category = $request->input('exercise_category');
        $problem_levels = $request->input('problem_levels');
        $problem_branches = $request->input('problem_branches');
        $problem_types = $request->input('problem_types');
    
        // Fetch problems based on selected levels, branches, and types
        $problem_set = Problem::query();
    
        if (!empty($problem_levels)) {
            $problem_set->whereIn('problem_level_id', $problem_levels);
        }
    
        if (!empty($problem_branches)) {
            $problem_set->whereIn('problem_branch_id', $problem_branches);
        }
    
        if (!empty($problem_types)) {
            $problem_set->whereIn('problem_type_id', $problem_types);
        }
    
        $problem_set = $problem_set->get();
        
        dd($problem_set);
        return redirect()->route('exercise.start', $query);
    }
    
    public function start(Request $request) {
        $id = $request->query('id');
        $selected = $request->query('type');
        $categories = explode(",", $request->query('categories'));
        $categories = array_values($categories);
    
        // Check if "core" or "arithmetic" is selected
        $coreSelected = in_array('core', $categories);
        $arithmeticSelected = in_array('arithmetic', $categories);
    
        // Check if specific operations are selected
        $additionSelected = in_array('addition', $categories);
        $subtractionSelected = in_array('subtraction', $categories);
        $multiplicationSelected = in_array('multiplication', $categories);
        $divisionSelected = in_array('division', $categories);
    
        // Fetch problems based on the selected categories
        $problemQuery = Problem::select('problems.*')
            ->join('problem_categories', 'problems.id', '=', 'problem_categories.problem_id')
            ->join('categories', 'problem_categories.category_id', '=', 'categories.id');
    
        if ($coreSelected) {
            // Add "core" category to the query
            $problemQuery->orWhere('categories.title', 'core');
        }
    
        if ($arithmeticSelected) {
            // Add "arithmetic" category to the query
            $problemQuery->orWhere('categories.title', 'arithmetic');
        }
    
        if ($additionSelected || $subtractionSelected || $multiplicationSelected || $divisionSelected) {
            // Add specific operations to the query
            if ($additionSelected) {
                $problemQuery->orWhere('categories.title', 'addition');
            }
            if ($subtractionSelected) {
                $problemQuery->orWhere('categories.title', 'subtraction');
            }
            if ($multiplicationSelected) {
                $problemQuery->orWhere('categories.title', 'multiplication');
            }
            if ($divisionSelected) {
                $problemQuery->orWhere('categories.title', 'division');
            }
        }
    
        // Get the problems matching the query
        $problem_set = $problemQuery->get();
    
        return Inertia::render('Exercise/Start', [
            'problemSet' => $problem_set,
            'selected' => $selected,
            'id' => $id
        ]);
    }
    

    public function summary(Request $request) {
        $summary = $request->input('summary');
        return Inertia::render('Exercise/Summary');

    }

    public function end() {

    }

    
}
