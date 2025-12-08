@extends('layouts.app')

@section('title', 'Profil - Lyon Palme')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="nav-container">
        <div class="container">
            <div class="nav-flex">
                <div class="nav-left">
                    <div class="nav-logo">
                        <h1 class="nav-title">Lyon Palme</h1>
                    </div>
                    <div class="nav-links">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="nav-link-active">
                            Profil
                        </a>
                    </div>
                </div>
                <div class="nav-right">
                    <div class="nav-user-menu">
                        <div class="nav-user-info">
                            <span class="nav-username">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container section">
            <h2 class="page-title">
                Profil Utilisateur
            </h2>
        </div>
    </header>

    <!-- Main Content -->
    <div class="section">
        <div class="container">
            <div class="content-sections">
            
            <!-- Informations du profil -->
            <div class="content-card">
                <h3 class="content-title">Informations du profil</h3>
                
                @if (session('status') === 'profile-updated')
                    <div class="form-success">
                        <p>Profil mis à jour avec succès.</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" 
                               class="form-input-enhanced">
                        @error('name')
                            <p class="form-error-enhanced">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group spaced">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" 
                               class="form-input-enhanced">
                        @error('email')
                            <p class="form-error-enhanced">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <div></div>
                        <button type="submit" class="btn-primary">
                            Sauvegarder
                        </button>
                    </div>
                </form>
            </div>

            <!-- Changer le mot de passe -->
            <div class="content-card">
                <h3 class="content-title">Changer le mot de passe</h3>
                
                @if (session('status') === 'password-updated')
                    <div class="form-success">
                        <p>Mot de passe mis à jour avec succès.</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Mot de passe actuel -->
                    <div class="form-group">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password" id="current_password" 
                               class="form-input-enhanced">
                        @error('current_password')
                            <p class="form-error-enhanced">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nouveau mot de passe -->
                    <div class="form-group spaced">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" 
                               class="form-input-enhanced">
                        @error('password')
                            <p class="form-error-enhanced">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmer le nouveau mot de passe -->
                    <div class="form-group spaced">
                        <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-input-enhanced">
                        @error('password_confirmation')
                            <p class="form-error-enhanced">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <div></div>
                        <button type="submit" class="btn-primary">
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <!-- Supprimer le compte -->
            <div class="content-card">
                <h3 class="content-title" style="color: #dc2626;">Supprimer le compte</h3>
                <p class="info-description">
                    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
                </p>
                
                <button onclick="confirmDelete()" class="btn-danger">
                    Supprimer le compte
                </button>

                <!-- Modal de confirmation (simple) -->
                <div id="deleteModal" class="delete-modal">
                    <div class="delete-modal-content">
                        <h4 class="delete-modal-title">Confirmer la suppression</h4>
                        <p class="delete-modal-text">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                        <div class="delete-modal-actions">
                            <button onclick="hideDeleteModal()" class="btn-secondary">
                                Annuler
                            </button>
                            <form method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    Supprimer définitivement
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('show');
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('show');
}
</script>
@endsection
