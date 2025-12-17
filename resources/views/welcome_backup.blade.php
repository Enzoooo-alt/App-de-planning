@extends('layouts.app')

@section('title', 'Lyon Palme - Club de Natation')

@section('content')
    .hero-bg {
        background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 50%, #38bdf8 100%);
    }
    .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }
    .wave svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 80px;
    }
    .wave .shape-fill {
        fill: #ffffff;
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    /* Override navigation for home page */
    .home-nav {
        position: fixed !important;
        top: 0 !important;
        z-index: 1000 !important;
        background: white !important;
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.06), 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-blue-600">🏊 Lyon Palme</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Tableau de bord</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">S'inscrire</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg relative pt-16 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-20">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Bienvenue au <span class="text-yellow-300">Lyon Palme</span>
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                    Votre club de natation passionné où l'excellence rencontre la convivialité. 
                    Rejoignez-nous pour vivre votre passion de la natation !
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="bg-yellow-400 text-blue-900 hover:bg-yellow-300 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                            Rejoindre le club
                        </a>
                        <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                            Se connecter
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="bg-yellow-400 text-blue-900 hover:bg-yellow-300 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300">
                            Accéder au tableau de bord
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pourquoi choisir Lyon Palme ?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Découvrez tous les avantages de faire partie de notre communauté de nageurs passionnés
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg bg-blue-50 hover:bg-blue-100 transition duration-300">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🏊‍♀️</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Entraînements de qualité</h3>
                    <p class="text-gray-600">Des séances d'entraînement adaptées à tous les niveaux avec des entraîneurs expérimentés</p>
                </div>
                <div class="text-center p-6 rounded-lg bg-blue-50 hover:bg-blue-100 transition duration-300">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📅</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Planning flexible</h3>
                    <p class="text-gray-600">Un système de planning intelligent qui s'adapte à vos disponibilités</p>
                </div>
                <div class="text-center p-6 rounded-lg bg-blue-50 hover:bg-blue-100 transition duration-300">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🤝</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Communauté soudée</h3>
                    <p class="text-gray-600">Rejoignez une famille de nageurs qui partagent votre passion</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Lyon Palme en chiffres</h2>
            </div>
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">150+</div>
                    <div class="text-gray-600">Membres actifs</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">12</div>
                    <div class="text-gray-600">Entraîneurs qualifiés</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">25+</div>
                    <div class="text-gray-600">Séances par semaine</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">15</div>
                    <div class="text-gray-600">Années d'expérience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Prêt à plonger dans l'aventure ?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Rejoignez Lyon Palme dès aujourd'hui et découvrez le plaisir de nager dans une atmosphère conviviale et professionnelle
            </p>
            @guest
                <a href="{{ route('register') }}" class="bg-yellow-400 text-blue-900 hover:bg-yellow-300 px-8 py-3 rounded-lg text-lg font-semibold transition duration-300 inline-block">
                    S'inscrire maintenant
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">🏊 Lyon Palme</h3>
                <p class="text-gray-400 mb-4">Votre club de natation de référence à Lyon</p>
                <div class="flex justify-center space-x-6">
                    <span class="text-gray-400">📧 contact@lyonpalme.fr</span>
                    <span class="text-gray-400">📞 04 XX XX XX XX</span>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <p class="text-gray-400">&copy; {{ date('Y') }} Lyon Palme. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
