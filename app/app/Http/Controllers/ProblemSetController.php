<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Problem;

class ProblemSetController extends Controller
{
    public function index() {
        return Inertia::render('Exercise/Index');
    }

    public function select(Request $request) {
        $type = $request->input('type', '');

        if($type === 'practice') {
            return Inertia::render('Exercise/Practice/Define', [
                'query' => 'practice_define',
            ]);
            
        } elseif ($type === 'assestment') {
            return Inertia::render('Exercise/Assestment/Select', [
                'query' => 'assestment_select'
            ]);
        } else {
            return Redirect::route('problem_set.index');

        }


    }
    
    public function define(Request $request): RedirectResponse {
        $type = $request->input('type');

        $args = [
            'problem_count' => $request->input('problem_count'),
            'category' => $request->input('category'),
        ];
    
        return Redirect::route('exercise/create/' + $type, ['data' => $args]);
    }

    public function create(Request $request) {
        $data = $request->input('data');
        return Redirect::route('exercise/attempt', $data);
    }

    public function show(Request $request) {
       
        
    }
}
