@extends('layouts.app-v2')

@section('title', 'Feuille de présence')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('seances.index') }}" style="color: var(--lp-teal); text-decoration: none;">Séances</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Présences</span>
    </nav>

    <!-- En-tête -->
    <div class="card" style="margin-bottom: 2rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal));">
        <div style="padding: var(--lp-space-lg); color: white;">
            <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">
                📋 Feuille de présence
            </h1>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
                <div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">Séance</div>
                    <div style="font-size: 1.125rem; font-weight: 600;">{{ $seance->entrainement->nom ?? 'Sans nom' }}</div>
                </div>
                <div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">Date</div>
                    <div style="font-size: 1.125rem; font-weight: 600;">{{ $seance->date_seance->format('d/m/Y') }}</div>
                </div>
                <div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">Horaires</div>
                    <div style="font-size: 1.125rem; font-weight: 600;">{{ $seance->heure_debut }} - {{ $seance->heure_fin }}</div>
                </div>
                <div>
                    <div style="font-size: 0.875rem; opacity: 0.9;">Entraîneur</div>
                    <div style="font-size: 1.125rem; font-weight: 600;">{{ $seance->entraineur->prenom ?? '' }} {{ $seance->entraineur->nom ?? 'Non assigné' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="card" style="margin-bottom: 2rem; background: var(--lp-bg-ocean);">
        <div style="padding: var(--lp-space-lg);">
            <div style="display: flex; align-items: start; gap: 1rem;">
                <div style="flex-shrink: 0; font-size: 2rem;">ℹ️</div>
                <div>
                    <h2 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                        Instructions
                    </h2>
                    <p style="color: var(--lp-text-muted); margin-bottom: 0.5rem;">
                        Marquez la présence de chaque adhérent en sélectionnant un statut. Vous pouvez ajouter une note pour justifier une absence.
                    </p>
                    <div style="display: flex; gap: 2rem; margin-top: 1rem; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="badge badge-success">✓ Présent</span>
                            <span style="color: var(--lp-text-muted); font-size: 0.875rem;">L'adhérent était présent</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="badge badge-danger">✗ Absent</span>
                            <span style="color: var(--lp-text-muted); font-size: 0.875rem;">Absence non justifiée</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span class="badge badge-warning">📋 Excusé</span>
                            <span style="color: var(--lp-text-muted); font-size: 0.875rem;">Absence justifiée</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de présences -->
    <form method="POST" action="{{ route('presences.store') }}">
        @csrf
        <input type="hidden" name="seance_id" value="{{ $seance->id }}">

        <div class="card">
            <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--lp-navy);">
                    Liste des adhérents ({{ $adherents->count() }})
                </h2>
            </div>

            <div id="presence-list">
                @forelse($adherents as $index => $adherent)
                    <div class="presence-row" style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border); transition: background 0.2s;"
                         onmouseover="this.style.background='var(--lp-bg-ocean)'"
                         onmouseout="this.style.background='white'">
                        <input type="hidden" name="presences[{{ $index }}][adherent_id]" value="{{ $adherent->id }}">
                        
                        <div style="display: grid; grid-template-columns: 2fr 3fr 1fr; gap: 1.5rem; align-items: start;">
                            <!-- Nom de l'adhérent -->
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div class="avatar">
                                    {{ strtoupper(substr($adherent->prenom, 0, 1)) }}{{ strtoupper(substr($adherent->nom, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--lp-navy);">
                                        {{ $adherent->prenom }} {{ $adherent->nom }}
                                    </div>
                                    @if($adherent->niveau)
                                        <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                            Niveau: {{ ucfirst($adherent->niveau) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Statut -->
                            <div>
                                <label style="font-weight: 600; color: var(--lp-navy); font-size: 0.875rem; display: block; margin-bottom: 0.5rem;">
                                    Statut *
                                </label>
                                <div style="display: flex; gap: 0.5rem;">
                                    @php
                                        $currentPresence = $presences->get($adherent->id);
                                        $currentStatut = $currentPresence ? $currentPresence->statut : 'present';
                                    @endphp
                                    
                                    <label class="radio-card" style="flex: 1;">
                                        <input type="radio" 
                                               name="presences[{{ $index }}][statut]" 
                                               value="present" 
                                               {{ $currentStatut === 'present' ? 'checked' : '' }}
                                               onchange="toggleNoteField({{ $index }}, this.value)">
                                        <span class="radio-label success">✓ Présent</span>
                                    </label>
                                    
                                    <label class="radio-card" style="flex: 1;">
                                        <input type="radio" 
                                               name="presences[{{ $index }}][statut]" 
                                               value="absent" 
                                               {{ $currentStatut === 'absent' ? 'checked' : '' }}
                                               onchange="toggleNoteField({{ $index }}, this.value)">
                                        <span class="radio-label danger">✗ Absent</span>
                                    </label>
                                    
                                    <label class="radio-card" style="flex: 1;">
                                        <input type="radio" 
                                               name="presences[{{ $index }}][statut]" 
                                               value="excuse" 
                                               {{ $currentStatut === 'excuse' ? 'checked' : '' }}
                                               onchange="toggleNoteField({{ $index }}, this.value)">
                                        <span class="radio-label warning">📋 Excusé</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Bouton pour ajouter une note -->
                            <div>
                                <button type="button" 
                                        class="btn btn-sm btn-secondary"
                                        onclick="document.getElementById('note-{{ $index }}').style.display = document.getElementById('note-{{ $index }}').style.display === 'none' ? 'block' : 'none'">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Note
                                </button>
                            </div>
                        </div>

                        <!-- Note (masquée par défaut) -->
                        <div id="note-{{ $index }}" 
                             style="margin-top: 1rem; display: {{ $currentPresence && $currentPresence->note ? 'block' : 'none' }};">
                            <label style="font-weight: 600; color: var(--lp-navy); font-size: 0.875rem; display: block; margin-bottom: 0.5rem;">
                                Note / Justification
                            </label>
                            <textarea 
                                name="presences[{{ $index }}][note]" 
                                class="form-input" 
                                rows="2"
                                placeholder="Ajouter une note ou une justification d'absence..."
                                style="resize: vertical;">{{ $currentPresence ? $currentPresence->note : '' }}</textarea>
                        </div>
                    </div>
                @empty
                    <div style="padding: 3rem; text-align: center; color: var(--lp-text-muted);">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">👥</div>
                        <div style="font-weight: 600;">Aucun adhérent actif</div>
                        <div>Il n'y a actuellement aucun adhérent inscrit et actif dans le système.</div>
                    </div>
                @endforelse
            </div>

            @if($adherents->count() > 0)
                <div style="padding: var(--lp-space-lg); border-top: 2px solid var(--lp-border); display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('seances.show', $seance) }}" class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Enregistrer les présences
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>

<style>
.radio-card {
    position: relative;
    cursor: pointer;
    display: block;
}

.radio-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.radio-label {
    display: block;
    padding: 0.5rem 0.75rem;
    border: 2px solid var(--lp-border);
    border-radius: var(--lp-radius);
    text-align: center;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.2s;
    background: white;
}

.radio-card input[type="radio"]:checked + .radio-label.success {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

.radio-card input[type="radio"]:checked + .radio-label.danger {
    background: #ef4444;
    border-color: #ef4444;
    color: white;
}

.radio-card input[type="radio"]:checked + .radio-label.warning {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

.radio-label:hover {
    border-color: var(--lp-teal);
}
</style>

<script>
function toggleNoteField(index, statut) {
    const noteField = document.getElementById('note-' + index);
    // Afficher automatiquement la note pour les absences
    if (statut === 'absent' || statut === 'excuse') {
        noteField.style.display = 'block';
    }
}
</script>
@endsection
