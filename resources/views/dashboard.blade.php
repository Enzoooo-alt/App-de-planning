@extends('layouts.app')

@section('title', 'Dashboard - Lyon Palme')

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
                        <a href="{{ route('dashboard') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
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
                Tableau de Bord Lyon Palme
            </h2>
        </div>
    </header>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de bienvenue -->
            <div class="mb-6 overflow-hidden bg-gradient-to-r from-blue-500 to-indigo-600 shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Bienvenue sur Lyon Palme !</h3>
                    <p>Gérez vos entraînements de natation synchronisée depuis votre tableau de bord.</p>
                </div>
            </div>

            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Entraîneurs -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Entraîneurs</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['trainers'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Adhérents -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Adhérents</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['members'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Programmes d'entraînement -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Programmes</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['trainings'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Séances -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Séances</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['sessions'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sections principales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Séances à venir -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Séances à venir</h3>
                    @if($upcomingSessions && count($upcomingSessions) > 0)
                        <div class="space-y-3">
                            @foreach($upcomingSessions as $session)
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $session->entrainement->titre ?? 'Programme sans titre' }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($session->dateSeance)->format('d/m/Y') }} 
                                        de {{ \Carbon\Carbon::parse($session->heureDebut)->format('H:i') }} 
                                        à {{ \Carbon\Carbon::parse($session->heureFin)->format('H:i') }}
                                    </p>
                                </div>
                                <div class="text-xs text-gray-400">
                                    @if($session->entrainement && $session->entrainement->entraineur)
                                        {{ $session->entrainement->entraineur->prenom }} {{ $session->entrainement->entraineur->nom }}
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">Aucune séance programmée</p>
                        </div>
                    @endif
                </div>

                <!-- Entraînements récents -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Programmes récents</h3>
                    @if($recentTrainings && count($recentTrainings) > 0)
                        <div class="space-y-3">
                            @foreach($recentTrainings as $training)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $training->titre }}</p>
                                    <p class="text-xs text-gray-500">
                                        @if($training->entraineur)
                                            Par {{ $training->entraineur->prenom }} {{ $training->entraineur->nom }}
                                        @endif
                                    </p>
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($training->dateCreation)->format('d/m/Y') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500">Aucun programme créé</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informations système -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        🎉 Bienvenue sur Lyon Palme !
                    </h3>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-gray-700 mb-3">
                            Vous êtes maintenant connecté à la plateforme Lyon Palme. Cette application vous permet de :
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                Créer et gérer vos entraînements de natation synchronisée
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                Planifier des séances d'entraînement
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                Suivre la progression des adhérents
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                Échanger avec d'autres entraîneurs
                            </li>
                        </ul>
                        <div class="mt-4 pt-4 border-t border-blue-200">
                            <p class="text-xs text-gray-500">
                                💡 Conseil : Cette version simplifiée se concentre sur l'affichage des statistiques et des informations essentielles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
