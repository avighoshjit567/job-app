<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\JobPostController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('job-post', [JobPostController::class, 'index'])->name('job.post');
    Route::get('job-post/create', [JobPostController::class, 'create'])->name('job.post.create');
    Route::post('job-post/save', [JobPostController::class, 'store'])->name('job.post.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
