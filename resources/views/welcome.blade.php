@extends('layouts.app')

@section('title', 'Lyon Palme - Bienvenue')

@section('content')
<div class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-blue-600">Lyon Palme</h1>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Inscription</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative gradient-bg">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative container">
            <div class="text-center section">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Bienvenue chez</span>
                    <span class="block text-yellow-400 animate-float">Lyon Palme</span>
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-blue-100 sm:max-w-3xl">
                    Votre plateforme de gestion pour la natation synchronisée. Organisez vos entraînements, suivez vos progrès et connectez-vous avec votre équipe.
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary md:py-4 md:text-lg md:px-10">
                            Accéder au Dashboard
                        </a>
                    @else
                        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">
                            <a href="{{ route('register') }}" class="btn-primary md:py-4 md:text-lg md:px-10">
                                Commencer
                            </a>
                            <a href="{{ route('login') }}" class="btn-secondary md:py-4 md:text-lg md:px-10">
                                Se connecter
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Floating elements -->
        <div class="absolute top-20 left-10 animate-pulse-slow floating-element small yellow"></div>
        <div class="absolute top-32 right-20 animate-pulse-slow floating-element medium blue" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 animate-pulse-slow floating-element large indigo" style="animation-delay: 4s;"></div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Fonctionnalités</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Tout pour vos entraînements
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Lyon Palme vous offre tous les outils nécessaires pour gérer efficacement vos sessions de natation synchronisée.
                </p>
            </div>

            <div class="feature-grid">
                <!-- Feature 1 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="feature-title">Gestion des entraînements</p>
                    <dd class="feature-description">
                        Créez, organisez et suivez vos programmes d'entraînement de natation synchronisée.
                    </dd>
                </div>

                <!-- Feature 2 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="feature-title">Planning des séances</p>
                    <dd class="feature-description">
                        Planifiez facilement vos séances et gérez les horaires de votre équipe.
                    </dd>
                </div>

                <!-- Feature 3 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 715.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="feature-title">Suivi des adhérents</p>
                    <dd class="feature-description">
                        Gardez une trace des progrès de vos nageurs et de leur participation.
                    </dd>
                </div>

                <!-- Feature 4 -->
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="feature-title">Statistiques détaillées</p>
                    <dd class="feature-description">
                        Analysez les performances et suivez l'évolution avec des rapports complets.
                    </dd>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="gradient-bg">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Prêt à plonger ?</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-blue-100">
                Rejoignez Lyon Palme dès aujourd'hui et transformez la gestion de vos entraînements.
            </p>
            @guest
            <a href="{{ route('register') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 sm:w-auto transition duration-300 transform hover:scale-105">
                Commencer maintenant
            </a>
            @endguest
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <!-- Footer content can be added here -->
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">
                    &copy; {{ date('Y') }} Lyon Palme. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection
