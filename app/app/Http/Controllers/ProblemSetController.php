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

    public function select(Request $request): RedirectResponse {
        $exerciseSessionType = $request->input('exerciseSessionType', '');
        return Redirect::route('problem_set.show', ['type' => $exerciseSessionType]);
    }

    public function show(Request $request) {
        $type = $request->input('type');
        return Inertia::render('Exercise', [
            'problems' => Problem::all(),
            'type' => $type
        ]);
    }
}
