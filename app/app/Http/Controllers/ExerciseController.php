<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Problem;

class ExerciseController extends Controller
{
    private function save() {
        return Redirect::route('dashboard');
    }

    private function cancel() {

    }

    private function reset() {

    }

    public function select() {
        return Inertia::render('Exercise/Index');
    }

    public function config(Request $request) {
        $type = $request->input('type', '');
        switch ($type) {
            case 'practice':
                return Inertia::render('Exercise/Practice/Define', [
                    'type' => $type
                ]);
            case 'assestment':
                return Inertia::render('Exercise/Assestment/Select', [
                    'type' => $type
                ]);
        }

        return Redirect::route('exercise.select');

    }

    public function create(Request $request) {
        $type = $request->input('type');
        $query_params = $request->input('queryParams');
        $data =  [
            'type' => $type,
            'queryParams' => $query_params
        ];
        $problem_set = Problem::all();
        return redirect()->route('exercise.start');
    }
    
    public function start(Request $request) {
        $problem_set = Problem::all();
        return Inertia::render('Exercise/Attempt', [
            'problemSet' => $problem_set,
        ]);

    }

    public function review(Request $request) {
        $summary = $request->input('summary');
        return Inertia::render('Exercise/summary');

    }

    public function end() {

    }

    
}
