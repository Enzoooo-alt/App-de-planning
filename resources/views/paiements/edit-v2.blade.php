@extends('layouts.app-v2')

@section('title', 'Modifier le paiement')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('paiements.index') }}" style="color: var(--lp-teal); text-decoration: none;">Paiements</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('paiements.show', $paiement) }}" style="color: var(--lp-teal); text-decoration: none;">Détail</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Modifier</span>
    </nav>

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card">
            <div style="padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border);">
                <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--lp-navy);">
                    ✏️ Modifier le paiement
                </h1>
                <p style="color: var(--lp-text-muted); margin-top: 0.5rem;">
                    Modifiez les informations du paiement
                </p>
            </div>

            <div style="padding: var(--lp-space-lg);">
                <form method="POST" action="{{ route('paiements.update', $paiement) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-4">
                        <!-- Adhérent (lecture seule) -->
                        <div style="grid-column: span 2;">
                            <label class="label">Adhérent</label>
                            <div style="padding: 1rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius); display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 2.5rem; height: 2.5rem; background: var(--lp-teal); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                    {{ substr($paiement->adherent->prenom, 0, 1) }}{{ substr($paiement->adherent->nom, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--lp-navy);">
                                        {{ $paiement->adherent->prenom }} {{ $paiement->adherent->nom }}
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                        {{ $paiement->adherent->email }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Montant -->
                        <div>
                            <label for="montant" class="label">Montant (€) *</label>
                            <input type="number" name="montant" id="montant" step="0.01" min="0" 
                                   class="input @error('montant') input-error @enderror"
                                   value="{{ old('montant', $paiement->montant) }}" required>
                            @error('montant')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="date_paiement" class="label">Date du paiement *</label>
                            <input type="date" name="date_paiement" id="date_paiement" 
                                   class="input @error('date_paiement') input-error @enderror"
                                   value="{{ old('date_paiement', $paiement->date_paiement->format('Y-m-d')) }}" required>
                            @error('date_paiement')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="label">Type de paiement *</label>
                            <select name="type" id="type" class="input @error('type') input-error @enderror" required>
                                <option value="cotisation_annuelle" {{ old('type', $paiement->type) == 'cotisation_annuelle' ? 'selected' : '' }}>
                                    💰 Cotisation annuelle
                                </option>
                                <option value="stage" {{ old('type', $paiement->type) == 'stage' ? 'selected' : '' }}>
                                    🏊 Stage
                                </option>
                                <option value="competition" {{ old('type', $paiement->type) == 'competition' ? 'selected' : '' }}>
                                    🏆 Compétition
                                </option>
                                <option value="equipement" {{ old('type', $paiement->type) == 'equipement' ? 'selected' : '' }}>
                                    👕 Équipement
                                </option>
                                <option value="autre" {{ old('type', $paiement->type) == 'autre' ? 'selected' : '' }}>
                                    📋 Autre
                                </option>
                            </select>
                            @error('type')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Méthode -->
                        <div>
                            <label for="methode_paiement" class="label">Méthode de paiement *</label>
                            <select name="methode_paiement" id="methode_paiement" class="input @error('methode_paiement') input-error @enderror" required>
                                <option value="especes" {{ old('methode_paiement', $paiement->methode_paiement) == 'especes' ? 'selected' : '' }}>
                                    💵 Espèces
                                </option>
                                <option value="cheque" {{ old('methode_paiement', $paiement->methode_paiement) == 'cheque' ? 'selected' : '' }}>
                                    📝 Chèque
                                </option>
                                <option value="virement" {{ old('methode_paiement', $paiement->methode_paiement) == 'virement' ? 'selected' : '' }}>
                                    🏦 Virement
                                </option>
                                <option value="carte_bancaire" {{ old('methode_paiement', $paiement->methode_paiement) == 'carte_bancaire' ? 'selected' : '' }}>
                                    💳 Carte bancaire
                                </option>
                                <option value="en_ligne" {{ old('methode_paiement', $paiement->methode_paiement) == 'en_ligne' ? 'selected' : '' }}>
                                    🌐 Paiement en ligne
                                </option>
                            </select>
                            @error('methode_paiement')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="statut" class="label">Statut *</label>
                            <select name="statut" id="statut" class="input @error('statut') input-error @enderror" required>
                                <option value="en_attente" {{ old('statut', $paiement->statut) == 'en_attente' ? 'selected' : '' }}>
                                    ⏳ En attente
                                </option>
                                <option value="valide" {{ old('statut', $paiement->statut) == 'valide' ? 'selected' : '' }}>
                                    ✅ Validé
                                </option>
                                <option value="refuse" {{ old('statut', $paiement->statut) == 'refuse' ? 'selected' : '' }}>
                                    ❌ Refusé
                                </option>
                                <option value="rembourse" {{ old('statut', $paiement->statut) == 'rembourse' ? 'selected' : '' }}>
                                    💸 Remboursé
                                </option>
                            </select>
                            @error('statut')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Saison -->
                        <div>
                            <label for="saison" class="label">Saison *</label>
                            <input type="text" name="saison" id="saison" 
                                   class="input @error('saison') input-error @enderror"
                                   value="{{ old('saison', $paiement->saison) }}" 
                                   placeholder="2025-2026" required>
                            @error('saison')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Numéro de reçu -->
                        <div style="grid-column: span 2;">
                            <label for="recu_numero" class="label">Numéro de reçu</label>
                            <input type="text" name="recu_numero" id="recu_numero" 
                                   class="input @error('recu_numero') input-error @enderror"
                                   value="{{ old('recu_numero', $paiement->recu_numero) }}" 
                                   placeholder="Ex: REC-2025-001">
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-top: 0.25rem;">
                                Optionnel - Laissez vide si aucun reçu n'est émis
                            </div>
                            @error('recu_numero')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Note -->
                        <div style="grid-column: span 2;">
                            <label for="note" class="label">Note</label>
                            <textarea name="note" id="note" rows="3" 
                                      class="input @error('note') input-error @enderror"
                                      placeholder="Informations complémentaires...">{{ old('note', $paiement->note) }}</textarea>
                            @error('note')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('paiements.show', $paiement) }}" class="btn btn-secondary">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
