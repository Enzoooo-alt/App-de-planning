{{-- 
    Liste des Adhérents - Lyon Palme
    Vue pour l'affichage et la gestion des membres du club
    Design: Framework CSS Lyon-Palme violet professionnel
--}}
@extends('layouts.app')

@section('title', 'Adhérents - Lyon Palme')

@section('content')
<section style="padding: 2rem 0;">
    <div class="container">
        
        {{-- En-tête de la page adhérents --}}
        <div class="profile-section mb-6">
            <div class="profile-header">
                <h1 class="h1" style="display: flex; align-items: center; margin: 0;">
                    <span style="margin-right: 0.75rem; font-size: 2rem;">👥</span>
                    Adhérents du Club
                </h1>
                <p style="margin: 0.5rem 0 0; opacity: 0.95; font-size: 1.1rem;">
                    Gestion des membres et suivi de l'activité du club
                </p>
            </div>
            
            {{-- Actions en en-tête --}}
            <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('dashboard') }}" class="button button-secondary">
                        <span>←</span>
                        Retour au tableau de bord
                    </a>
                </div>
                
                <a href="{{ route('adherents.create') }}" class="button button-primary">
                    <span>➕</span>
                    Nouvel Adhérent
                </a>
            </div>
        </div>

        {{-- Messages de feedback --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem; background: var(--success-light); border: 2px solid var(--success); color: var(--success); padding: 1rem 1.25rem; border-radius: var(--radius); display: flex; align-items: center; font-weight: 500;">
                <span style="margin-right: 0.5rem; font-size: 1.1rem;">✅</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Statistiques rapides --}}
        <div class="grid md:grid-cols-4" style="gap: 1.5rem; margin-bottom: 2rem;">
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">👥</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--brand-primary); margin-bottom: 0.25rem;">
                    {{ $adherents->total() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Adhérent{{ $adherents->total() > 1 ? 's' : '' }} total{{ $adherents->total() > 1 ? 'aux' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">✅</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--success); margin-bottom: 0.25rem;">
                    {{ $adherents->where('actif', true)->count() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Membre{{ $adherents->where('actif', true)->count() > 1 ? 's' : '' }} actif{{ $adherents->where('actif', true)->count() > 1 ? 's' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🏊‍♀️</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--info); margin-bottom: 0.25rem;">
                    {{ $adherents->whereNotNull('niveau')->count() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Niveau{{ $adherents->whereNotNull('niveau')->count() > 1 ? 'x' : '' }} défini{{ $adherents->whereNotNull('niveau')->count() > 1 ? 's' : '' }}</div>
            </div>
            
            <div class="card" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📧</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--warning); margin-bottom: 0.25rem;">
                    {{ $adherents->whereNotNull('email')->count() }}
                </div>
                <div style="color: var(--text-muted); font-size: 0.875rem;">Contact{{ $adherents->whereNotNull('email')->count() > 1 ? 's' : '' }} email</div>
            </div>
        </div>

        {{-- Liste des adhérents --}}
        <div class="profile-section">
            @if($adherents->count() > 0)
                <div class="profile-header">
                    <h2 class="h3" style="margin: 0; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem; font-size: 1.25rem;">📋</span>
                        Liste des Adhérents ({{ $adherents->total() }} membre{{ $adherents->total() > 1 ? 's' : '' }})
                    </h2>
                </div>
                
                <div class="profile-content" style="padding: 0;">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">👤 Membre</th>
                                    <th style="text-align: left;">📧 Contact</th>
                                    <th style="text-align: left;">🏊‍♀️ Niveau</th>
                                    <th style="text-align: left;">📅 Adhésion</th>
                                    <th style="text-align: center;">🔘 Statut</th>
                                    <th style="text-align: center; width: 200px;">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adherents as $adherent)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div style="width: 40px; height: 40px; background: var(--brand-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--brand-primary);">
                                                    👤
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: var(--brand-primary);">
                                                        {{ $adherent->prenom }} {{ $adherent->nom }}
                                                    </div>
                                                    @if($adherent->date_naissance)
                                                        <div style="font-size: 0.875rem; color: var(--text-muted);">
                                                            {{ \Carbon\Carbon::parse($adherent->date_naissance)->age }} ans
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                @if($adherent->email)
                                                    <div style="font-weight: 500; margin-bottom: 2px;">
                                                        {{ $adherent->email }}
                                                    </div>
                                                @endif
                                                @if($adherent->telephone)
                                                    <div style="font-size: 0.875rem; color: var(--text-muted);">
                                                        📞 {{ $adherent->telephone }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($adherent->niveau)
                                                <span style="background: var(--info-light); color: var(--info); padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600; text-transform: capitalize;">
                                                    🏊‍♀️ {{ $adherent->niveau }}
                                                </span>
                                            @else
                                                <span style="color: var(--text-muted); font-style: italic;">Non défini</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-weight: 500;">
                                                {{ $adherent->created_at->format('d/m/Y') }}
                                            </div>
                                            <div style="font-size: 0.875rem; color: var(--text-muted);">
                                                {{ $adherent->created_at->diffForHumans() }}
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            @if($adherent->actif)
                                                <span style="background: var(--success-light); color: var(--success); padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    ✅ Actif
                                                </span>
                                            @else
                                                <span style="background: var(--danger-light); color: var(--danger); padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    ❌ Inactif
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                                <a href="{{ route('adherents.show', $adherent) }}" class="button button-secondary" style="padding: 6px 10px; font-size: 0.75rem;">
                                                    👁️ Voir
                                                </a>
                                                <a href="{{ route('adherents.edit', $adherent) }}" class="button" style="background: var(--warning); color: white; padding: 6px 10px; font-size: 0.75rem;">
                                                    ✏️ Modifier
                                                </a>
                                                <form method="POST" action="{{ route('adherents.destroy', $adherent) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button" style="background: var(--danger); color: white; padding: 6px 10px; font-size: 0.75rem;">
                                                        🗑️ Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if($adherents->hasPages())
                    <div style="padding: 1.5rem; border-top: 1px solid var(--border); background: var(--background-subtle);">
                        {{ $adherents->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">👥</div>
                    <h3 class="empty-title">Aucun adhérent enregistré</h3>
                    <p class="empty-description">Commencez par ajouter les premiers membres de votre club de natation.</p>
                    <a href="{{ route('adherents.create') }}" class="button button-primary" style="margin-top: 1rem;">
                        <span>👤</span>
                        Ajouter un adhérent
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
