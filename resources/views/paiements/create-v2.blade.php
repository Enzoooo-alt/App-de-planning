@extends('layouts.app-v2')

@section('title', 'Enregistrer un paiement')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('paiements.index') }}" style="color: var(--lp-teal); text-decoration: none;">Paiements</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Nouveau</span>
    </nav>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            Enregistrer un paiement
        </h1>
        <p style="color: var(--lp-text-muted);">Saisissez les informations du paiement reçu</p>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('paiements.store') }}" style="padding: var(--lp-space-lg);">
            @csrf

            <div class="form-group">
                <label for="adherent_id" class="form-label required">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                    </svg>
                    Adhérent
                </label>
                <select class="form-select @error('adherent_id') is-invalid @enderror" id="adherent_id" name="adherent_id" required>
                    <option value="">Sélectionnez un adhérent</option>
                    @foreach($adherents as $adherent)
                        <option value="{{ $adherent->id }}" {{ old('adherent_id') == $adherent->id ? 'selected' : '' }}>
                            {{ $adherent->prenom }} {{ $adherent->nom }}
                        </option>
                    @endforeach
                </select>
                @error('adherent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="montant" class="form-label required">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        Montant (€)
                    </label>
                    <input type="number" class="form-input @error('montant') is-invalid @enderror" id="montant" name="montant" 
                           value="{{ old('montant') }}" step="0.01" min="0" required>
                    @error('montant')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="date_paiement" class="form-label required">Date du paiement</label>
                    <input type="date" class="form-input @error('date_paiement') is-invalid @enderror" 
                           id="date_paiement" name="date_paiement" value="{{ old('date_paiement', date('Y-m-d')) }}" required>
                    @error('date_paiement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="type" class="form-label required">Type de paiement</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="cotisation_annuelle" {{ old('type') == 'cotisation_annuelle' ? 'selected' : '' }}>💰 Cotisation annuelle</option>
                        <option value="stage" {{ old('type') == 'stage' ? 'selected' : '' }}>🏊 Stage</option>
                        <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }}>🏆 Compétition</option>
                        <option value="equipement" {{ old('type') == 'equipement' ? 'selected' : '' }}>👕 Équipement</option>
                        <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>📋 Autre</option>
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="methode" class="form-label required">Méthode de paiement</label>
                    <select class="form-select @error('methode') is-invalid @enderror" id="methode" name="methode" required>
                        <option value="especes" {{ old('methode') == 'especes' ? 'selected' : '' }}>💵 Espèces</option>
                        <option value="cheque" {{ old('methode') == 'cheque' ? 'selected' : '' }}>📝 Chèque</option>
                        <option value="virement" {{ old('methode') == 'virement' ? 'selected' : '' }}>🏦 Virement</option>
                        <option value="cb" {{ old('methode') == 'cb' ? 'selected' : '' }}>💳 Carte bancaire</option>
                        <option value="autre" {{ old('methode') == 'autre' ? 'selected' : '' }}>📋 Autre</option>
                    </select>
                    @error('methode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="statut" class="form-label required">Statut</label>
                    <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                        <option value="valide" {{ old('statut', 'valide') == 'valide' ? 'selected' : '' }}>✓ Validé</option>
                        <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                        <option value="refuse" {{ old('statut') == 'refuse' ? 'selected' : '' }}>✗ Refusé</option>
                        <option value="rembourse" {{ old('statut') == 'rembourse' ? 'selected' : '' }}>↩ Remboursé</option>
                    </select>
                    @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="saison" class="form-label">Saison</label>
                    <input type="text" class="form-input @error('saison') is-invalid @enderror" 
                           id="saison" name="saison" value="{{ old('saison', '2025-2026') }}" placeholder="Ex: 2025-2026">
                    @error('saison')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="recu_numero" class="form-label">Numéro de reçu</label>
                <input type="text" class="form-input @error('recu_numero') is-invalid @enderror" 
                       id="recu_numero" name="recu_numero" value="{{ old('recu_numero') }}" placeholder="Ex: REC-2026-001">
                @error('recu_numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="note" class="form-label">Note / Remarque</label>
                <textarea class="form-input @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note') }}</textarea>
                @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer le paiement</button>
            </div>
        </form>
    </div>
</div>
@endsection
