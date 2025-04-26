<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

    Route::get('/type', [TypeController::class, 'index'])->name('type.index');
    Route::get('/type/create', [TypeController::class, 'create'])->name('type.create');
    Route::get('/type/edit/{id}', [TypeController::class, 'edit'])->name('type.edit');
    Route::post('/type', [TypeController::class, 'store'])->name('type.store');
    Route::patch('/type/{id}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('/type/{id}', [TypeController::class, 'destroy'])->name('type.destroy');

    Route::get('/job', [JobController::class, 'index'])->name('job.index');
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::get('/job/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
    Route::post('/job', [JobController::class, 'store'])->name('job.store');
    Route::patch('/job/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('job.destroy');

    Route::get('/user/', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/', [UserController::class, 'store'])->name('user.store');
    Route::patch('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';