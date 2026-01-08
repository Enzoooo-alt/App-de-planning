<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EntrainementController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MessageController;
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

// Routes du calendrier
Route::middleware(['auth'])->group(function () {
    Route::get('/calendrier', [CalendrierController::class, 'index'])->name('calendrier.index');
    Route::get('/calendrier/events', [CalendrierController::class, 'events'])->name('calendrier.events');
});

// Routes des actualités
Route::middleware(['auth'])->group(function () {
    Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
    Route::get('/actualites/manage', [ActualiteController::class, 'manage'])->name('actualites.manage')
        ->middleware('role:president,responsable_planning');
    Route::get('/actualites/create', [ActualiteController::class, 'create'])->name('actualites.create')
        ->middleware('role:president,responsable_planning');
    Route::post('/actualites', [ActualiteController::class, 'store'])->name('actualites.store')
        ->middleware('role:president,responsable_planning');
    Route::get('/actualites/{actualite}', [ActualiteController::class, 'show'])->name('actualites.show');
    Route::get('/actualites/{actualite}/edit', [ActualiteController::class, 'edit'])->name('actualites.edit')
        ->middleware('role:president,responsable_planning');
    Route::put('/actualites/{actualite}', [ActualiteController::class, 'update'])->name('actualites.update')
        ->middleware('role:president,responsable_planning');
    Route::delete('/actualites/{actualite}', [ActualiteController::class, 'destroy'])->name('actualites.destroy')
        ->middleware('role:president,responsable_planning');
});

// Routes des notifications
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
});

// Routes pour la gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Gestion des utilisateurs - Réservé aux président et responsable planning
    Route::resource('users', UserController::class)
        ->middleware('role:president,responsable_planning');
});

// Routes for resources (protected by role middleware)
Route::middleware(['auth'])->group(function () {
    // Entraîneurs - Index/Show accessible à tous, CRUD réservé à président/responsable
    Route::get('entraineurs', [TrainerController::class, 'index'])->name('entraineurs.index')
        ->middleware('role:president,responsable_planning,entraineur,membre');
    Route::get('entraineurs/{entraineur}', [TrainerController::class, 'show'])->name('entraineurs.show')
        ->middleware('role:president,responsable_planning,entraineur,membre');
    Route::get('entraineurs/create', [TrainerController::class, 'create'])->name('entraineurs.create')
        ->middleware('role:president,responsable_planning');
    Route::post('entraineurs', [TrainerController::class, 'store'])->name('entraineurs.store')
        ->middleware('role:president,responsable_planning');
    Route::get('entraineurs/{entraineur}/edit', [TrainerController::class, 'edit'])->name('entraineurs.edit')
        ->middleware('role:president,responsable_planning');
    Route::put('entraineurs/{entraineur}', [TrainerController::class, 'update'])->name('entraineurs.update')
        ->middleware('role:president,responsable_planning');
    Route::patch('entraineurs/{entraineur}', [TrainerController::class, 'update'])
        ->middleware('role:president,responsable_planning');
    Route::delete('entraineurs/{entraineur}', [TrainerController::class, 'destroy'])->name('entraineurs.destroy')
        ->middleware('role:president,responsable_planning');
    
    // Adhérents - Seuls président et responsable planning peuvent gérer
    Route::resource('adherents', MemberController::class)->middleware('role:president,responsable_planning');
    
    // Route pour assigner le rôle membre à un adhérent
    Route::post('adherents/{adherent}/assign-member-role', [MemberController::class, 'assignMemberRole'])
        ->name('adherents.assign-member-role')
        ->middleware('role:president,responsable_planning');
    
    // Entraînements - Tous sauf membres simples pour création/modification
    Route::resource('entrainements', EntrainementController::class)->except(['index', 'show'])
        ->middleware('role:president,responsable_planning,entraineur');
    Route::resource('entrainements', EntrainementController::class)->only(['index', 'show']);
    
    // Séances - Tous sauf membres simples pour création/modification
    Route::resource('seances', SeanceController::class)->except(['index', 'show'])
        ->middleware('role:president,responsable_planning,entraineur');
    Route::resource('seances', SeanceController::class)->only(['index', 'show']);
    
    // Présences - Accessible aux entraîneurs et responsables
    Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index')
        ->middleware('role:president,responsable_planning,entraineur');
    Route::get('/presences/seance/{seance}', [PresenceController::class, 'manage'])->name('presences.manage')
        ->middleware('role:president,responsable_planning,entraineur');
    Route::post('/presences', [PresenceController::class, 'store'])->name('presences.store')
        ->middleware('role:president,responsable_planning,entraineur');
    Route::get('/presences/adherent/{adherent}', [PresenceController::class, 'statistics'])->name('presences.statistics')
        ->middleware('role:president,responsable_planning,entraineur');
    
    // Paiements - Réservé aux président et responsable planning
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index')
        ->middleware('role:president,responsable_planning');
    Route::get('/paiements/dashboard', [PaiementController::class, 'dashboard'])->name('paiements.dashboard')
        ->middleware('role:president,responsable_planning');
    Route::resource('paiements', PaiementController::class)->except(['index'])
        ->middleware('role:president,responsable_planning');
    
    // Documents - Accessible à tous les membres connectés
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create')
        ->middleware('role:president,responsable_planning,entraineur');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store')
        ->middleware('role:president,responsable_planning,entraineur');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy')
        ->middleware('role:president,responsable_planning');
    
    // Messagerie - Accessible à tous les membres connectés
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{conversation}/send', [MessageController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/unread/count', [MessageController::class, 'unreadCount'])->name('messages.unread-count');
});

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