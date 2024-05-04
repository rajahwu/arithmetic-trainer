<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Category;

use App\Models\Problem;

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
        return Inertia::render('Exercise/Select');
    }
    
    public function settings(Request $request) {
        $selected = $request->input('selected', '');
        switch ($selected) {
            case 'practice':
                $categories = Category::all();
                return Inertia::render('Exercise/Practice/Settings', [
                    'selected' => $selected,
                    'categories' => $categories
                ]);

                case 'assestment':
                    return Inertia::render('Exercise/Assestment/Settings', [
                        'selected' => $selected
                    ]);

                case 'standard':
                    $categories = Category::all();
                    return Inertia::render('Exercise/Practice/Settings', [
                        'selected' => $selected,
                        'categories' => $categories
                ]);
        }
        return Redirect::route('exercise.select');

    }

    public function create(Request $request) {
        $selected = $request->input('selected');
        $categories = $request->input('categories');

        $query =  [
            'type' => $selected,
            'categories' => implode(",", $categories),
            'id' => "1"
        ];
        
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
