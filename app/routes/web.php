<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProblemSetController;
use App\Http\Controllers\ExerciseSessionController;
use App\Http\Controllers\StaticImageController;
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

Route::controller(ExerciseSessionController::class)->group(function() {
    Route::get('/exercise/select', 'select')->middleware(['auth', 'verified'])->name('exercise.select');
    Route::post('/exercise/settings/{type}/{category}', 'settings')->middleware(['auth', 'verified'])->name('exercise.settings');
    Route::post('/exercise/create/{type}/{category}', 'create')->middleware(['auth', 'verified'])->name('exercise.create');
    Route::get('/exercise/start', 'start')->middleware(['auth', 'verified'])->name('exercise.start');
    Route::get('/exercise/summary/{id}', 'summary')->middleware(['auth', 'verified'])->name('exercise.summary');
    Route::get('/exercise/end/{id}', 'end')->middleware(['auth', 'verified'])->name('exercise.end');
});

Route::get('/progress', function () {
    return Inertia::render('Progress');
})->middleware(['auth', 'verified'])->name('progress');

// Route::resource('exercise', ProblemController::class);

Route::controller(StaticImageController::class)->group(function() {
    Route::get('/images/site-logo', 'site_logo')->name('site-logo');
    Route::get('/images/site-title', 'site_title')->name('site-title');
});


require __DIR__.'/auth.php';
