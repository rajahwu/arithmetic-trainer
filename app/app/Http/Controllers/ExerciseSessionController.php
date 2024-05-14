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
use App\Models\PracticeProblemSet; 
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
        // dd($request);
        $exercise_type = $request->input('exercise_type');
        $exercise_category = $request->input('exercise_category');
        $problem_levels = $request->input('problem_levels');
        $problem_branches = $request->input('problem_branches');
        $problem_types = $request->input('problem_types');

        $session = null;
        $practiceProblemSets = [];

        if ($exercise_type === 'practice') {
            $title = $exercise_type . ' ' . $exercise_category;
            $session = Practice::create([
                'type' => $exercise_category,
                'title' => $title,
                'description' => $exercise_type . ' ' . $exercise_category,
                'created_by' => auth()->id()
            ]);
            // Loop through each combination of levels, branches, and types
            foreach ($problem_levels as $level) {
                foreach ($problem_branches as $branch) {
                    foreach ($problem_types as $type) {
                        // Fetch problems based on the selected levels, branches, and types
                        $problems = Problem::where('problem_level_id', $level)
                            ->where('problem_branch_id', $branch)
                            ->where('problem_type_id', $type)
                            ->get();
                        // Create practice problem set for each problem
                        foreach ($problems as $problem) {
                            $practiceProblemSets[] = PracticeProblemSet::create([
                                'practice_id' => $session->id,
                                'problem_id' => $problem->id
                            ]);
                        }
                    }
                }
            }
        }

        $exercise_session = ExerciseSession::create([
            'user_id' => auth()->id(),
            'type' => 'practice',
            'practice_id' => $session->id,
            'title' => $exercise_type . ' ' . $exercise_category,
            'description' => $exercise_type . ' ' . $exercise_category,
            'start_time' => now(), 
            'end_time' => null,
            'is_completed' => false
        ]);

        
        return redirect()->route('exercise.start', [
            'type' => $exercise_type,
            'category' => $exercise_category,
            'id' => $exercise_session->id,
        ]);
    }        
    
    public function start(Request $request) {
        $id = $request->query('id');
        $type = $request->query('type');
        $category = $request->query('category');
        // Fetch the ExerciseSession by ID
        $exercise_session = ExerciseSession::findOrFail($id);
        // Fetch all problems associated with the practice ID
        $problem_set = PracticeProblemSet::where('practice_id', $exercise_session->practice_id)->get();
        $count = $problem_set->count();
        $problems = [];
        foreach ($problem_set as $item) {
            $problem = Problem::find($item->problem_id);
            if ($problem) {
                $problems[] = [
                    'id' => $problem->id,
                    'problem_level_id' => $problem->problem_level_id,
                    'problem_branch_id' => $problem->problem_level_id,
                    'problem_type_id' => $problem->problem_level_id,
                    'text' => $problem->text,
                    'solution' => $problem->solution,
                    'explanation' => $problem->explanation,
                    'references' => $problem->references
                ];
            }
        }
        
        return Inertia::render('Exercise/Start', [
            'problemSet' => $problems,
            'count' => $count,
            'selected' => $exercise_session->type,
            'catagory' => $category,
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
