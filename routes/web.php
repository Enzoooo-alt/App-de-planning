<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Redirection vers login pour les visiteurs non authentifiés
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route pour récupérer un nouveau token CSRF
    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });

    // Routes pour les utilisateurs (adhérents)
    Route::resource('users', UserController::class);

    // Routes pour les plannings
    Route::resource('plannings', PlanningController::class);
    Route::post('plannings/{planning}/subscribe', [PlanningController::class, 'subscribe'])->name('plannings.subscribe');
    Route::delete('plannings/{planning}/unsubscribe', [PlanningController::class, 'unsubscribe'])->name('plannings.unsubscribe');

    // Route de profil
    Route::get('/profile', function() {
        return redirect()->route('users.show', auth()->id());
    })->name('profile.show');

    // Routes pour les entraînements
    Route::resource('trainings', TrainingController::class);
    Route::get('trainings/{training}/download-pdf', [TrainingController::class, 'downloadPdf'])->name('trainings.download-pdf');
});
