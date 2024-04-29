<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProblemSetController;
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

Route::controller(ProblemSetController::class)->group(function() {
    Route::get('/exercise', 'index')->middleware(['auth', 'verified'])->name('problem_set.index');
    Route::post('/exercise/select/{type}', 'select')->middleware(['auth', 'verified'])->name('problem_set.select');
    Route::post('/exercise/create/{type}', 'create')->middleware(['auth', 'verified'])->name('problem_set.create');
    Route::get('/exercise/attempt', 'show')->middleware(['auth', 'verified'])->name('problem_set.show');
});

Route::get('/progress', function () {
    return Inertia::render('Progress');
})->middleware(['auth', 'verified'])->name('progress');

// Route::resource('exercise', ProblemController::class);



require __DIR__.'/auth.php';
