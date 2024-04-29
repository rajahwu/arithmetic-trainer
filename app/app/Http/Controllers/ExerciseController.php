<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;

class ExerciseController extends Controller
{
    public function index() {
        return Inertia::render('Exercise/Index');
    }

    public function select(Request $request) {
        $type = $request->input('type', '');

        if($type === 'practice') {
            return Inertia::render('Exercise/Practice/Define', [
                'type' => $type
            ]);
        } elseif ($type === 'assestment') {
            return Inertia::render('Exercise/Assestment/Select', [
                'type' => $type
            ]);
        } else {
            return Redirect::route('exercise.index');

        }


    }

    public function create(Request $request) {
        $type = $request->input('type');
        $query_params = $request->input('queryParams');

        return Inertia::render('Exercise/Create', [
            'type' => $type,
            'queryParams' => $query_params,
        ]);

    }

    public function attempt(Request $request) {
        $problem_set = Problem::all();
        return Inertia::render('Exercise/attempt', [
            'problemSet' => $problem_set;
        ]);

    }

    public function summary(Request $request) {
        $summary = $request->input('summary');
        return Inertia::render('Exercise/summary');

    }

    public function save() {
        return Redirect::route('dashboard');
    }

    public function cancel() {

    }

    public function reset() {
        
    }
}
