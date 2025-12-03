@extends('layouts.app')

@section('title', 'Profil - Lyon Palme')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-blue-600">Lyon Palme</h1>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Profil
                        </a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-gray-700">
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
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Profil Utilisateur
            </h2>
        </div>
    </header>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Informations du profil -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations du profil</h3>
                    
                    @if (session('status') === 'profile-updated')
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                            <p class="text-green-800">Profil mis à jour avec succès.</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- Nom -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                                Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Changer le mot de passe -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Changer le mot de passe</h3>
                    
                    @if (session('status') === 'password-updated')
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                            <p class="text-green-800">Mot de passe mis à jour avec succès.</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Mot de passe actuel -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmer le nouveau mot de passe -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                                Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Supprimer le compte -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">Supprimer le compte</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
                    </p>
                    
                    <button onclick="confirmDelete()" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                        Supprimer le compte
                    </button>

                    <!-- Modal de confirmation (simple) -->
                    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Confirmer la suppression</h4>
                            <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                            <div class="flex gap-4">
                                <button onclick="hideDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md">
                                    Annuler
                                </button>
                                <form method="POST" action="{{ route('profile.destroy') }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
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
}

function hideDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection
