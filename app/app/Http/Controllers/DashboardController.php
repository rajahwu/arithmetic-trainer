<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\ExerciseSession;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $exercise_sessions = ExerciseSession::where('user_id', Auth::id())->get(); // Use Auth::id()
        // dd($exercise_sessions);
        return Inertia::render('Dashboard', [
           'exerciseSessions' => $exercise_sessions
        ]);
    }
}
