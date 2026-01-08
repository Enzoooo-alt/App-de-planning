@extends('layouts.app-v2')

@section('title', 'Nouveau message')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('messages.index') }}" style="color: var(--lp-teal); text-decoration: none;">Messages</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Nouveau</span>
    </nav>

    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
            Nouveau message
        </h1>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('messages.store') }}" style="padding: var(--lp-space-lg);">
            @csrf

            <div class="form-group">
                <label for="destinataires" class="form-label required">Destinataires</label>
                <select class="form-select @error('destinataires') is-invalid @enderror" id="destinataires" name="destinataires[]" multiple required style="height: 150px;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ in_array($user->id, old('destinataires', [])) ? 'selected' : '' }}>
                            {{ $user->name }} - {{ $user->role->nom_role ?? 'Membre' }}
                        </option>
                    @endforeach
                </select>
                @error('destinataires')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small style="color: var(--lp-text-muted); font-size: 0.875rem; display: block; margin-top: 0.25rem;">
                    Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs destinataires
                </small>
            </div>

            <div class="form-group">
                <label for="titre" class="form-label">Titre (optionnel pour les groupes)</label>
                <input type="text" class="form-input @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" placeholder="Ex: Planning de la semaine">
                @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="contenu" class="form-label required">Message</label>
                <textarea class="form-input @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="8" required>{{ old('contenu') }}</textarea>
                @error('contenu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid var(--lp-border);">
                <a href="{{ route('messages.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
