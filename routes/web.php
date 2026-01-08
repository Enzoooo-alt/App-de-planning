<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EntrainementController;
use App\Http\Controllers\SeanceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-v2');
});

// Ancienne version (backup)
Route::get('/welcome-old', function () {
    return view('welcome');
})->name('welcome.old');

// Route de démonstration du Design System Maritime
Route::get('/demo-maritime', function () {
    return view('demo-maritime');
})->name('demo.maritime');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Routes pour la gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for resources (accessible without auth for now)
Route::resource('entraineurs', TrainerController::class);
Route::resource('adherents', MemberController::class);
Route::resource('entrainements', EntrainementController::class);
Route::resource('seances', SeanceController::class);

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/reglement', function () {
    return view('legal.reglement');
})->name('reglement');