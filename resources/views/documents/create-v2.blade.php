@extends('layouts.app-v2')

@section('title', 'Ajouter un document')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('documents.index') }}" style="color: var(--lp-teal); text-decoration: none;">Documents</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Nouveau</span>
    </nav>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
            Ajouter un document
        </h1>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" style="padding: var(--lp-space-lg);">
            @csrf

            <div class="form-group">
                <label for="titre" class="form-label required">Titre du document</label>
                <input type="text" class="form-input @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" required>
                @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-input @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="fichier" class="form-label required">Fichier</label>
                <input type="file" class="form-input @error('fichier') is-invalid @enderror" id="fichier" name="fichier" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                @error('fichier')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                    Formats acceptés : PDF, Word, Excel, Images. Taille max : 10 MB
                </small>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="categorie" class="form-label required">Catégorie</label>
                    <select class="form-select @error('categorie') is-invalid @enderror" id="categorie" name="categorie" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="reglement" {{ old('categorie') == 'reglement' ? 'selected' : '' }}>📋 Règlement</option>
                        <option value="technique" {{ old('categorie') == 'technique' ? 'selected' : '' }}>🏊 Technique</option>
                        <option value="administratif" {{ old('categorie') == 'administratif' ? 'selected' : '' }}>📄 Administratif</option>
                        <option value="autre" {{ old('categorie') == 'autre' ? 'selected' : '' }}>📁 Autre</option>
                    </select>
                    @error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="visible_par" class="form-label required">Visible par</label>
                    <select class="form-select @error('visible_par') is-invalid @enderror" id="visible_par" name="visible_par" required>
                        <option value="tous" {{ old('visible_par') == 'tous' ? 'selected' : '' }}>👥 Tous</option>
                        <option value="adherents_only" {{ old('visible_par', 'adherents_only') == 'adherents_only' ? 'selected' : '' }}>🏊 Adhérents uniquement</option>
                        <option value="entraineurs_only" {{ old('visible_par') == 'entraineurs_only' ? 'selected' : '' }}>👨‍🏫 Entraîneurs uniquement</option>
                        <option value="admin_only" {{ old('visible_par') == 'admin_only' ? 'selected' : '' }}>🔒 Administrateurs uniquement</option>
                    </select>
                    @error('visible_par')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Ajouter le document</button>
            </div>
        </form>
    </div>
</div>
@endsection
