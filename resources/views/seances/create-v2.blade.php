@extends('layouts.app-v2')

@section('title', 'Planifier une Séance - Lyon Palme')

@section('content')
<div class="container" style="padding: 2rem 0;">
    
    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Planifier une Séance
                </h1>
                <p style="color: var(--lp-text-muted); font-size: 1.125rem;">
                    Ajouter un créneau au planning
                </p>
            </div>
            <a href="{{ route('seances.index') }}" class="btn btn-outline">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Retour au planning
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: white; margin: 0;">
                Détails de la Séance
            </h2>
        </div>
        
        <form action="{{ route('seances.store') }}" method="POST" style="padding: var(--lp-space-lg);">
            @csrf

            <!-- Messages d'erreur généraux -->
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 2rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <div>
                        <strong>Erreurs de validation :</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem; list-style: disc;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Programme d'entraînement -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="entrainement_id" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                        Programme d'entraînement
                    </label>
                    <select 
                        class="form-select @error('entrainement_id') is-invalid @enderror" 
                        id="entrainement_id" 
                        name="entrainement_id"
                        required
                    >
                        <option value="">Sélectionner un programme...</option>
                        @foreach($entrainements as $entrainement)
                            <option value="{{ $entrainement->id }}" {{ old('entrainement_id') == $entrainement->id ? 'selected' : '' }}>
                                {{ $entrainement->titre }} 
                                @if($entrainement->entraineur)
                                    - {{ $entrainement->entraineur->user->name ?? '' }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('entrainement_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de la séance -->
                <div class="form-group">
                    <label for="date_seance" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Date de la séance
                    </label>
                    <input 
                        type="date" 
                        class="form-control @error('date_seance') is-invalid @enderror" 
                        id="date_seance" 
                        name="date_seance" 
                        value="{{ old('date_seance', date('Y-m-d')) }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >
                    @error('date_seance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lieu -->
                <div class="form-group">
                    <label for="lieu" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Lieu
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('lieu') is-invalid @enderror" 
                        id="lieu" 
                        name="lieu" 
                        value="{{ old('lieu', 'Piscine Lyon Palme') }}"
                        placeholder="Piscine Lyon Palme"
                        required
                    >
                    @error('lieu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de début -->
                <div class="form-group">
                    <label for="heure_debut" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Heure de début
                    </label>
                    <input 
                        type="time" 
                        class="form-control @error('heure_debut') is-invalid @enderror" 
                        id="heure_debut" 
                        name="heure_debut" 
                        value="{{ old('heure_debut', '18:00') }}"
                        required
                    >
                    @error('heure_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de fin -->
                <div class="form-group">
                    <label for="heure_fin" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Heure de fin
                    </label>
                    <input 
                        type="time" 
                        class="form-control @error('heure_fin') is-invalid @enderror" 
                        id="heure_fin" 
                        name="heure_fin" 
                        value="{{ old('heure_fin', '19:30') }}"
                        required
                    >
                    @error('heure_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text">L'heure de fin doit être après l'heure de début</small>
                </div>

                <!-- Commentaires -->
                <div class="form-group" style="grid-column: span 2;">
                    <label for="commentaires" class="form-label">
                        <svg width="16" height="16" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        Commentaires ou consignes
                    </label>
                    <textarea 
                        class="form-control @error('commentaires') is-invalid @enderror" 
                        id="commentaires" 
                        name="commentaires" 
                        rows="4"
                        placeholder="Informations complémentaires, matériel nécessaire, consignes particulières..."
                    >{{ old('commentaires') }}</textarea>
                    @error('commentaires')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('seances.index') }}" class="btn btn-outline">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Planifier la séance
                </button>
            </div>
        </form>
    </div>

    <!-- Aide contextuelle -->
    <div class="card" style="margin-top: 2rem; background: var(--lp-bg-ocean); border: 2px solid var(--lp-teal);">
        <div style="padding: var(--lp-space-lg);">
            <div style="display: flex; gap: 1rem;">
                <div style="flex-shrink: 0;">
                    <svg width="24" height="24" fill="none" stroke="var(--lp-teal)" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div>
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                        Conseils pour planifier une séance
                    </h3>
                    <ul style="color: var(--lp-text-secondary); line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                        <li>Sélectionnez un programme d'entraînement existant</li>
                        <li>Vérifiez les disponibilités du lieu et de l'entraîneur</li>
                        <li>L'heure de fin doit être postérieure à l'heure de début</li>
                        <li>Prévoyez une durée adaptée au niveau des participants</li>
                        <li>Ajoutez des commentaires pour informations importantes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Séances à venir -->
    @if(isset($prochaines_seances) && $prochaines_seances->count() > 0)
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header">
            <h2 style="font-size: 1.25rem; font-weight: 600; color: white; margin: 0;">
                Prochaines Séances Planifiées
            </h2>
        </div>
        <div style="padding: var(--lp-space-md);">
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($prochaines_seances->take(3) as $seance)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius-md);">
                        <div>
                            <div style="font-weight: 600; color: var(--lp-navy);">
                                {{ $seance->entrainement->titre ?? 'N/A' }}
                            </div>
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                {{ $seance->date_seance->format('d/m/Y') }} • {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                            </div>
                        </div>
                        <span class="badge badge-success">Programmée</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
// Validation automatique des horaires
document.addEventListener('DOMContentLoaded', function() {
    const heureDebut = document.getElementById('heure_debut');
    const heureFin = document.getElementById('heure_fin');
    
    function validateHoraires() {
        if (heureDebut.value && heureFin.value) {
            if (heureFin.value <= heureDebut.value) {
                heureFin.setCustomValidity('L\'heure de fin doit être après l\'heure de début');
            } else {
                heureFin.setCustomValidity('');
            }
        }
    }
    
    heureDebut.addEventListener('change', validateHoraires);
    heureFin.addEventListener('change', validateHoraires);
});
</script>
@endsection
