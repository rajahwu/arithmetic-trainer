<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProblemSetController;
use App\Http\Controllers\ExerciseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ExerciseController::class)->group(function() {
    Route::get('/exercise/select', 'select')->middleware(['auth', 'verified'])->name('exercise.select');
    Route::post('/exercise/{type}/settings/', 'config')->middleware(['auth', 'verified'])->name('exercise.config');
    Route::post('/exercise/{type}/create', 'create')->middleware(['auth', 'verified'])->name('exercise.create');
    Route::get('/exercise/attempt', 'start')->middleware(['auth', 'verified'])->name('exercise.start');
    Route::get('/exercise/summary', 'summary')->middleware(['auth', 'verified'])->name('exercise.summary');
});

Route::get('/progress', function () {
    return Inertia::render('Progress');
})->middleware(['auth', 'verified'])->name('progress');

// Route::resource('exercise', ProblemController::class);



require __DIR__.'/auth.php';
