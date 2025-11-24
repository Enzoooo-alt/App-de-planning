<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ Modifier {{ $training->title }} - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen animated-gradient">
    <!-- 🌊 Particles d'arrière-plan magiques -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="particles">
            @for($i = 0; $i < 30; $i++)
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
                    <a href="{{ route('trainings.show', $training) }}" class="text-white/80 hover:text-white">{{ Str::limit($training->title, 20) }}</a>
                    <span class="text-white/70">→</span>
                    <span class="text-white font-medium">Modifier</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('trainings.show', $training) }}" class="btn-secondary">
                        ← Annuler
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- 🎨 En-tête -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-4 mb-4">
                <span class="text-5xl">
                    @switch($training->type)
                        @case('technique') 🎯 @break
                        @case('endurance') 💪 @break
                        @case('vitesse') ⚡ @break
                        @case('competition') 🏆 @break
                    @endswitch
                </span>
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white animate-fade-in">
                        ✏️ Modifier l'Entraînement
                    </h1>
                    <p class="text-xl text-white/80 mt-2">{{ $training->title }}</p>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="error-alert mb-6">
                <div class="font-semibold mb-2">❌ Erreurs détectées:</div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 🎯 Formulaire de modification -->
        <div class="glass-card p-8 animate-fade-in">
            <form action="{{ route('trainings.update', $training) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Informations de base -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="lg:col-span-2">
                        <label for="title" class="form-label">🏊‍♂️ Titre de l'entraînement</label>
                        <input type="text" id="title" name="title" 
                               class="form-input" 
                               placeholder="Ex: Technique crawl perfectionnement"
                               value="{{ old('title', $training->title) }}" required>
                        <p class="form-help">Donnez un titre clair et descriptif</p>
                    </div>

                    <div>
                        <label for="type" class="form-label">🎯 Type d'entraînement</label>
                        <select id="type" name="type" class="form-input" required>
                            <option value="">Sélectionner le type</option>
                            <option value="technique" {{ old('type', $training->type) === 'technique' ? 'selected' : '' }}>
                                🎯 Technique
                            </option>
                            <option value="endurance" {{ old('type', $training->type) === 'endurance' ? 'selected' : '' }}>
                                💪 Endurance
                            </option>
                            <option value="vitesse" {{ old('type', $training->type) === 'vitesse' ? 'selected' : '' }}>
                                ⚡ Vitesse
                            </option>
                            <option value="competition" {{ old('type', $training->type) === 'competition' ? 'selected' : '' }}>
                                🏆 Compétition
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="niveau" class="form-label">📊 Niveau requis</label>
                        <select id="niveau" name="niveau" class="form-input" required>
                            <option value="">Sélectionner le niveau</option>
                            <option value="debutant" {{ old('niveau', $training->niveau) === 'debutant' ? 'selected' : '' }}>
                                🟢 Débutant
                            </option>
                            <option value="intermediaire" {{ old('niveau', $training->niveau) === 'intermediaire' ? 'selected' : '' }}>
                                🟡 Intermédiaire
                            </option>
                            <option value="avance" {{ old('niveau', $training->niveau) === 'avance' ? 'selected' : '' }}>
                                🟠 Avancé
                            </option>
                            <option value="competition" {{ old('niveau', $training->niveau) === 'competition' ? 'selected' : '' }}>
                                🔴 Compétition
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="duree_minutes" class="form-label">⏱️ Durée (minutes)</label>
                        <input type="number" id="duree_minutes" name="duree_minutes" 
                               class="form-input" 
                               min="15" max="300" step="5"
                               placeholder="60"
                               value="{{ old('duree_minutes', $training->duree_minutes) }}" required>
                        <p class="form-help">Entre 15 et 300 minutes</p>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="form-label">📝 Description détaillée</label>
                    <textarea id="description" name="description" rows="6" 
                              class="form-input resize-none"
                              placeholder="Décrivez les objectifs, exercices principaux, matériel nécessaire...">{{ old('description', $training->description) }}</textarea>
                    <p class="form-help">Détaillez le contenu et les objectifs de l'entraînement</p>
                </div>

                <!-- Fichier PDF -->
                <div>
                    <label for="pdf_file" class="form-label">📄 Fichier PDF</label>
                    
                    @if($training->pdf_path)
                        <div class="current-file-display mb-4">
                            <div class="flex items-center justify-between p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📄</span>
                                    <div>
                                        <div class="font-medium text-white">Fichier actuel</div>
                                        <div class="text-sm text-white/70">{{ basename($training->pdf_path) }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('trainings.download-pdf', $training) }}" 
                                       class="btn-icon" title="Télécharger">
                                        ⬇️
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="file-upload-zone" onclick="document.getElementById('pdf_file').click()">
                        <input type="file" id="pdf_file" name="pdf_file" 
                               class="hidden" accept=".pdf"
                               onchange="updateFileName(this)">
                        <div class="text-center">
                            <div class="text-4xl mb-2">📄</div>
                            <div class="text-white font-medium mb-1">
                                @if($training->pdf_path)
                                    Remplacer le fichier PDF
                                @else
                                    Ajouter un fichier PDF
                                @endif
                            </div>
                            <div class="text-white/60 text-sm">Fiche d'entraînement détaillée (max 10 MB)</div>
                            <div id="file-name" class="text-blue-300 text-sm mt-2 hidden"></div>
                        </div>
                    </div>
                    
                    @if($training->pdf_path)
                        <p class="form-help mt-2">Laissez vide pour conserver le fichier actuel</p>
                    @endif
                </div>

                <!-- Plannings associés -->
                @if($plannings->count() > 0)
                    <div>
                        <label class="form-label">🗓️ Plannings associés</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($plannings as $planning)
                                @php
                                    $isChecked = $training->plannings->contains($planning->id) || 
                                               in_array($planning->id, old('planning_ids', []));
                                @endphp
                                <label class="checkbox-card">
                                    <input type="checkbox" name="planning_ids[]" 
                                           value="{{ $planning->id }}" 
                                           class="hidden peer"
                                           {{ $isChecked ? 'checked' : '' }}>
                                    <div class="checkbox-content">
                                        <div class="flex items-center justify-between">
                                            <span class="font-medium">{{ $planning->title }}</span>
                                            <span class="text-2xl">{{ $planning->getTypeEmoji() }}</span>
                                        </div>
                                        <div class="text-sm text-white/70 mt-1">
                                            {{ $planning->formatted_date }} • {{ $planning->formatted_time }}
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p class="form-help">Sélectionnez les plannings où cet entraînement sera utilisé</p>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-white/10">
                    <button type="submit" class="btn-primary flex-1 sm:flex-none">
                        💾 Sauvegarder les Modifications
                    </button>
                    <button type="button" onclick="resetToOriginal()" class="btn-secondary">
                        🔄 Réinitialiser
                    </button>
                    <a href="{{ route('trainings.show', $training) }}" class="btn-outline flex-1 sm:flex-none">
                        ❌ Annuler
                    </a>
                </div>
            </form>
        </div>

        <!-- 🗑️ Zone de suppression -->
        <div class="glass-card p-6 mt-8 border-2 border-red-500/30 animate-slide-up">
            <h3 class="text-xl font-bold text-red-300 mb-4 flex items-center gap-2">
                ⚠️ Zone de Danger
            </h3>
            <p class="text-white/80 mb-4">
                Cette action supprimera définitivement l'entraînement et toutes ses associations avec les plannings.
            </p>
            <form action="{{ route('trainings.destroy', $training) }}" method="POST" 
                  onsubmit="return confirmDelete()" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    🗑️ Supprimer cet Entraînement
                </button>
            </form>
        </div>
    </main>

    <script>
        // Données originales pour la réinitialisation
        const originalData = {
            title: @json($training->title),
            type: @json($training->type),
            niveau: @json($training->niveau),
            duree_minutes: @json($training->duree_minutes),
            description: @json($training->description),
            planning_ids: @json($training->plannings->pluck('id')->toArray())
        };

        function updateFileName(input) {
            const fileName = document.getElementById('file-name');
            if (input.files.length > 0) {
                fileName.textContent = `📄 ${input.files[0].name}`;
                fileName.classList.remove('hidden');
            } else {
                fileName.classList.add('hidden');
            }
        }

        function resetToOriginal() {
            if (confirm('🤔 Réinitialiser aux valeurs d\'origine ?')) {
                // Reset des champs
                document.getElementById('title').value = originalData.title;
                document.getElementById('type').value = originalData.type;
                document.getElementById('niveau').value = originalData.niveau;
                document.getElementById('duree_minutes').value = originalData.duree_minutes;
                document.getElementById('description').value = originalData.description || '';
                
                // Reset du fichier
                document.getElementById('pdf_file').value = '';
                document.getElementById('file-name').classList.add('hidden');
                
                // Reset des plannings
                document.querySelectorAll('input[name="planning_ids[]"]').forEach(checkbox => {
                    checkbox.checked = originalData.planning_ids.includes(parseInt(checkbox.value));
                });
            }
        }

        function confirmDelete() {
            return confirm('🚨 ATTENTION !\n\nÊtes-vous absolument sûr de vouloir supprimer cet entraînement ?\n\n' +
                          '• Cette action est irréversible\n' +
                          '• L\'entraînement sera retiré de tous les plannings\n' +
                          '• Le fichier PDF sera également supprimé\n\n' +
                          'Tapez "SUPPRIMER" pour confirmer') && 
                   prompt('Tapez "SUPPRIMER" en majuscules pour confirmer:') === 'SUPPRIMER';
        }

        // Auto-suggestions basées sur le type (comme dans create)
        document.getElementById('type').addEventListener('change', function() {
            const descriptionInput = document.getElementById('description');
            
            // Ne pas écraser si il y a déjà du contenu personnalisé
            if (descriptionInput.value === originalData.description || !descriptionInput.value.trim()) {
                const suggestions = {
                    'technique': 'Séance axée sur l\'amélioration de la technique de nage.\n\nObjectifs :\n- Correction des défauts techniques\n- Fluidité du mouvement\n- Efficacité de la nage\n\nMatériel : planches, pull-buoy, palmes courtes',
                    'endurance': 'Séance de développement de la capacité aérobie.\n\nObjectifs :\n- Amélioration de l\'endurance\n- Développement du système cardio-vasculaire\n- Résistance à la fatigue\n\nIntensité : modérée à soutenue',
                    'vitesse': 'Séance de développement de la vitesse de nage.\n\nObjectifs :\n- Amélioration de la vitesse maximale\n- Développement de la puissance\n- Travail de l\'explosivité\n\nIntensité : maximale avec récupération complète',
                    'competition': 'Séance de préparation spécifique à la compétition.\n\nObjectifs :\n- Simulation des conditions de course\n- Travail du rythme de course\n- Préparation mentale\n\nSpécificité épreuve et distance'
                };

                if (suggestions[this.value] && confirm('Remplacer la description par un modèle ?')) {
                    descriptionInput.value = suggestions[this.value];
                }
            }
        });

        // Validation en temps réel
        document.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                const errorMsg = this.parentElement.querySelector('.text-red-400');
                if (errorMsg) errorMsg.remove();
            });
        });

        // Détection des modifications non sauvegardées
        let hasUnsavedChanges = false;
        document.querySelector('form').addEventListener('input', () => hasUnsavedChanges = true);
        document.querySelector('form').addEventListener('submit', () => hasUnsavedChanges = false);

        window.addEventListener('beforeunload', function(e) {
            if (hasUnsavedChanges) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
</body>
</html>
