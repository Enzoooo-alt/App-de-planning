<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CompetitionController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Routes pour les utilisateurs (adhérents)
Route::resource('users', UserController::class);

// Routes pour les plannings
Route::resource('plannings', PlanningController::class);
Route::post('plannings/{planning}/register', [PlanningController::class, 'register'])->name('plannings.register');
Route::delete('plannings/{planning}/unregister', [PlanningController::class, 'unregister'])->name('plannings.unregister');

// Routes pour les entraînements PDF
Route::resource('trainings', TrainingController::class);
Route::get('trainings/{training}/download', [TrainingController::class, 'download'])->name('trainings.download');

// Routes pour le matériel
Route::resource('materials', MaterialController::class);
Route::post('materials/{material}/borrow', [MaterialController::class, 'borrow'])->name('materials.borrow');
Route::post('materials/{material}/return', [MaterialController::class, 'returnItem'])->name('materials.return');

// Routes pour les compétitions
Route::resource('competitions', CompetitionController::class);
Route::post('competitions/{competition}/register', [CompetitionController::class, 'register'])->name('competitions.register');
Route::delete('competitions/{competition}/unregister', [CompetitionController::class, 'unregister'])->name('competitions.unregister');
