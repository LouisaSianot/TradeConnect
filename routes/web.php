<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradespersonProfileController;
use App\Http\Controllers\JobPostingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/tradesperson/create', [TradespersonProfileController::class, 'create'])
    ->name('tradesperson-profile.create');
    Route::post('/profile/tradesperson', [TradespersonProfileController::class, 'store'])
    ->name('tradesperson-profile.store');
    Route::get('/profile/tradesperson/{tradespersonProfile}', [TradespersonProfileController::class, 'show'])
    ->name('tradesperson-profile.show');
    Route::get('/profile/tradesperson/{tradespersonProfile}/edit', [TradespersonProfileController::class, 'edit'])
    ->name('tradesperson-profile.edit');
    Route::put('/profile/tradesperson/{tradespersonProfile}', [TradespersonProfileController::class, 'update'])
    ->name('tradesperson-profile.update');
    Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobPostingController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}', [JobPostingController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/respond', [JobPostingController::class, 'respond'])->name('jobs.respond');
    Route::post('/jobs/{job}/complete', [JobPostingController::class, 'complete'])->name('jobs.complete');
});

require __DIR__.'/auth.php';
