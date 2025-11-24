<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏊‍♂️ {{ $training->title }} - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen animated-gradient">
    <!-- 🌊 Particles d'arrière-plan magiques -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="particles">
            @for($i = 0; $i < 40; $i++)
                <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 3000) }}ms;"></div>
            @endfor
        </div>
    </div>

    <!-- 🚀 Navigation supérieure -->
    <nav class="glass-effect sticky top-0 z-50 backdrop-blur-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 hover-lift">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center shadow-glow">
                            <span class="text-white font-bold text-lg">🏊‍♂️</span>
                        </div>
                        <span class="text-white font-bold text-xl">Lyon Palme</span>
                    </a>
                    <span class="text-white/70">→</span>
                    <a href="{{ route('trainings.index') }}" class="text-white/80 hover:text-white">Entraînements</a>
                    <span class="text-white/70">→</span>
                    <span class="text-white font-medium">{{ Str::limit($training->title, 30) }}</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if($training->pdf_path)
                        <a href="{{ route('trainings.download-pdf', $training) }}" class="btn-accent">
                            📄 Télécharger PDF
                        </a>
                    @endif
                    <a href="{{ route('trainings.edit', $training) }}" class="btn-primary">
                        ✏️ Modifier
                    </a>
                    <a href="{{ route('trainings.index') }}" class="btn-secondary">
                        ← Retour
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="success-alert mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- 🎨 En-tête de l'entraînement -->
        <div class="glass-card p-8 mb-8 animate-fade-in">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="text-6xl">
                            @switch($training->type)
                                @case('technique') 🎯 @break
                                @case('endurance') 💪 @break
                                @case('vitesse') ⚡ @break
                                @case('competition') 🏆 @break
                            @endswitch
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                                {{ $training->title }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="type-badge type-{{ $training->type }}">
                                    {{ ucfirst($training->type) }}
                                </span>
                                <span class="level-badge level-{{ $training->niveau }}">
                                    @switch($training->niveau)
                                        @case('debutant') 🟢 Débutant @break
                                        @case('intermediaire') 🟡 Intermédiaire @break
                                        @case('avance') 🟠 Avancé @break
                                        @case('competition') 🔴 Compétition @break
                                    @endswitch
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center lg:text-right">
                    <div class="glass-card bg-white/5 p-6 border border-white/20">
                        <div class="text-4xl font-bold text-blue-300 mb-1">{{ $training->duree_minutes }}'</div>
                        <div class="text-white/70 font-medium">Durée</div>
                        @if($training->pdf_path)
                            <div class="mt-4 pt-4 border-t border-white/20">
                                <a href="{{ route('trainings.download-pdf', $training) }}" 
                                   class="flex items-center justify-center gap-2 text-blue-300 hover:text-blue-200 transition-colors">
                                    <span class="text-2xl">📄</span>
                                    <span class="font-medium">Fiche PDF</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- 📝 Contenu principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                @if($training->description)
                    <div class="glass-card p-6 animate-slide-up">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                            📝 Description de l'entraînement
                        </h2>
                        <div class="text-white/90 leading-relaxed whitespace-pre-line">
                            {{ $training->description }}
                        </div>
                    </div>
                @endif

                <!-- Recommandations -->
                <div class="glass-card p-6 animate-slide-up">
                    <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                        💡 Recommandations
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="recommendation-item">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🎯</span>
                                <span class="font-semibold text-white">Objectif principal</span>
                            </div>
                            <p class="text-white/80 text-sm">
                                @switch($training->type)
                                    @case('technique')
                                        Amélioration de la technique de nage et correction des défauts
                                    @break
                                    @case('endurance')
                                        Développement de la capacité aérobie et de l'endurance
                                    @break
                                    @case('vitesse')
                                        Amélioration de la vitesse de nage et de l'explosivité
                                    @break
                                    @case('competition')
                                        Préparation spécifique aux conditions de compétition
                                    @break
                                @endswitch
                            </p>
                        </div>

                        <div class="recommendation-item">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">⚡</span>
                                <span class="font-semibold text-white">Intensité</span>
                            </div>
                            <p class="text-white/80 text-sm">
                                @switch($training->type)
                                    @case('technique')
                                        Modérée - Focus sur la qualité du mouvement
                                    @break
                                    @case('endurance')
                                        Modérée à soutenue - Zone aérobie
                                    @break
                                    @case('vitesse')
                                        Maximale - Récupération complète entre séries
                                    @break
                                    @case('competition')
                                        Variable selon la phase de préparation
                                    @break
                                @endswitch
                            </p>
                        </div>

                        <div class="recommendation-item">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">👥</span>
                                <span class="font-semibold text-white">Public cible</span>
                            </div>
                            <p class="text-white/80 text-sm">
                                Nageurs de niveau {{ $training->niveau }}
                                @if($training->niveau === 'debutant')
                                    - Apprentissage des bases
                                @elseif($training->niveau === 'intermediaire')
                                    - Perfectionnement technique
                                @elseif($training->niveau === 'avance')
                                    - Performance et optimisation
                                @else
                                    - Préparation haute performance
                                @endif
                            </p>
                        </div>

                        <div class="recommendation-item">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🏊‍♂️</span>
                                <span class="font-semibold text-white">Matériel suggéré</span>
                            </div>
                            <p class="text-white/80 text-sm">
                                @switch($training->type)
                                    @case('technique')
                                        Planches, pull-buoy, palmes courtes, élastiques
                                    @break
                                    @case('endurance')
                                        Pull-buoy, plaquettes, tuba frontal
                                    @break
                                    @case('vitesse')
                                        Palmes, élastiques, plaquettes, parachute
                                    @break
                                    @case('competition')
                                        Matériel spécifique selon les épreuves
                                    @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Plannings associés -->
                @if($training->plannings->count() > 0)
                    <div class="glass-card p-6 animate-slide-up">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                            🗓️ Plannings utilisant cet entraînement
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($training->plannings as $planning)
                                <a href="{{ route('plannings.show', $planning) }}" class="planning-link-card">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-semibold text-white">{{ $planning->title }}</h3>
                                            <p class="text-white/70 text-sm">
                                                {{ $planning->formatted_date }} • {{ $planning->formatted_time }}
                                            </p>
                                            <p class="text-white/60 text-xs mt-1">
                                                {{ $planning->participants->count() }} participants
                                            </p>
                                        </div>
                                        <span class="text-3xl">{{ $planning->getTypeEmoji() }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- 📊 Panneau latéral -->
            <div class="space-y-6">
                <!-- Actions rapides -->
                <div class="glass-card p-6 animate-slide-up">
                    <h3 class="text-xl font-bold text-white mb-4">⚡ Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('trainings.edit', $training) }}" 
                           class="action-button bg-blue-500/20 hover:bg-blue-500/30 border-blue-500/30">
                            <span class="text-2xl">✏️</span>
                            <div>
                                <div class="font-medium">Modifier</div>
                                <div class="text-xs text-white/70">Éditer cet entraînement</div>
                            </div>
                        </a>

                        @if($training->pdf_path)
                            <a href="{{ route('trainings.download-pdf', $training) }}" 
                               class="action-button bg-green-500/20 hover:bg-green-500/30 border-green-500/30">
                                <span class="text-2xl">📄</span>
                                <div>
                                    <div class="font-medium">Télécharger PDF</div>
                                    <div class="text-xs text-white/70">Fiche d'entraînement</div>
                                </div>
                            </a>
                        @endif

                        <button onclick="shareTraining()" 
                                class="action-button bg-purple-500/20 hover:bg-purple-500/30 border-purple-500/30 w-full">
                            <span class="text-2xl">📤</span>
                            <div>
                                <div class="font-medium">Partager</div>
                                <div class="text-xs text-white/70">Copier le lien</div>
                            </div>
                        </button>

                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" 
                              onsubmit="return confirm('🤔 Êtes-vous sûr de vouloir supprimer cet entraînement ?')" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-button bg-red-500/20 hover:bg-red-500/30 border-red-500/30 w-full">
                                <span class="text-2xl">🗑️</span>
                                <div>
                                    <div class="font-medium">Supprimer</div>
                                    <div class="text-xs text-white/70">Action irréversible</div>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Informations techniques -->
                <div class="glass-card p-6 animate-slide-up">
                    <h3 class="text-xl font-bold text-white mb-4">📊 Informations</h3>
                    <div class="space-y-4">
                        <div class="info-item">
                            <span class="info-label">📅 Créé le</span>
                            <span class="info-value">{{ $training->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🔄 Modifié le</span>
                            <span class="info-value">{{ $training->updated_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🗓️ Plannings</span>
                            <span class="info-value">{{ $training->plannings->count() }} associé(s)</span>
                        </div>
                        @if($training->pdf_path)
                            <div class="info-item">
                                <span class="info-label">📄 PDF</span>
                                <span class="info-value">Disponible</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Entraînements similaires -->
                @php
                    $similarTrainings = \App\Models\Training::where('id', '!=', $training->id)
                        ->where('type', $training->type)
                        ->where('niveau', $training->niveau)
                        ->take(3)
                        ->get();
                @endphp

                @if($similarTrainings->count() > 0)
                    <div class="glass-card p-6 animate-slide-up">
                        <h3 class="text-xl font-bold text-white mb-4">🔍 Similaires</h3>
                        <div class="space-y-3">
                            @foreach($similarTrainings as $similar)
                                <a href="{{ route('trainings.show', $similar) }}" 
                                   class="similar-training-card">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium text-white truncate">{{ $similar->title }}</h4>
                                            <p class="text-white/60 text-sm">{{ $similar->duree_minutes }}' • {{ ucfirst($similar->niveau) }}</p>
                                        </div>
                                        <span class="text-xl ml-2">
                                            @switch($similar->type)
                                                @case('technique') 🎯 @break
                                                @case('endurance') 💪 @break
                                                @case('vitesse') ⚡ @break
                                                @case('competition') 🏆 @break
                                            @endswitch
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        function shareTraining() {
            const url = window.location.href;
            
            if (navigator.share) {
                navigator.share({
                    title: '🏊‍♂️ {{ $training->title }}',
                    text: 'Découvrez cet entraînement de natation sur Lyon Palme',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    // Afficher une notification de succès
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-up';
                    notification.textContent = '✅ Lien copié dans le presse-papier !';
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }).catch(() => {
                    alert('Impossible de copier le lien. URL: ' + url);
                });
            }
        }

        // Animation d'apparition des éléments
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up');
                }
            });
        });

        document.querySelectorAll('.glass-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
