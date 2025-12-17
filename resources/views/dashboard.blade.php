@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <!-- Header avec informations utilisateur -->
        <div class="dashboard-card mb-6">
            <div class="dashboard-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="font-size: 2rem; margin-bottom: 8px;">Bonjour, {{ $user->name }} !</h1>
                        <p style="margin: 0; opacity: 0.9;">
                            Rôle: 
                            <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">
                                {{ $user->role ? ucfirst(str_replace('_', ' ', $user->role->nom_role)) : 'Membre' }}
                            </span>
                        </p>
                    </div>
                    <div style="text-align: right; opacity: 0.9;">
                        <p style="margin: 0; font-size: 1.125rem;">{{ now()->format('d/m/Y') }}</p>
                        <p style="margin: 0; font-size: 0.875rem;">Lyon Palme</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques générales - Permissions basées sur les rôles -->
        <div class="grid {{ $user->role && in_array($user->role->nom_role, ['president', 'responsable_planning']) ? 'grid-cols-4' : 'grid-cols-2' }} mb-8">
            <div class="metric-card">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: var(--brand-teal); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🏊</div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 4px;">Mes Séances</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text);">{{ $stats['mes_seances'] ?? $stats['total_seances'] }}</div>
                    </div>
                </div>
            </div>

            <div class="metric-card">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: var(--brand-amber); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📅</div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 4px;">{{ $user->role && $user->role->nom_role === 'entraineur' ? 'Mes Entraînements' : 'Entraînements' }}</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text);">{{ $stats['mes_entrainements'] ?? $stats['total_entrainements'] }}</div>
                    </div>
                </div>
            </div>

            @if($user->role && in_array($user->role->nom_role, ['president', 'responsable_planning']))
            <div class="metric-card">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: var(--brand-navy); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">👥</div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 4px;">Total Membres</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text);">{{ $stats['total_membres'] }}</div>
                    </div>
                </div>
            </div>

            <div class="metric-card">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: var(--pool-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🏊</div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--muted); margin-bottom: 4px;">Entraîneurs</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text);">{{ $stats['total_entraineurs'] }}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Contenu spécifique selon le rôle -->
        @if($user && $user->role)
            @if($user->role->nom_role === 'president')
                @include('dashboard.president', ['data' => $roleSpecificData])
            @elseif($user->role->nom_role === 'responsable_planning')
                @include('dashboard.responsable-planning', ['data' => $roleSpecificData])
            @elseif($user->role->nom_role === 'entraineur')
                @include('dashboard.entraineur', ['data' => $roleSpecificData])
            @else
                @include('dashboard.membre', ['data' => $roleSpecificData])
            @endif
        @endif

        <!-- Actions rapides -->
        <div class="mt-8">
            <div class="dashboard-card">
                <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 16px; color: var(--text);">Actions rapides</h3>
                <div class="grid grid-cols-4">
                    @if($user && $user->hasAnyRole(['president', 'responsable_planning']))
                        <a href="/entrainements/create" class="card" style="text-decoration: none; color: var(--text);">
                            <div style="text-align: center;">
                                <div style="font-size: 2rem; margin-bottom: 8px;">➕</div>
                                <div style="font-size: 0.875rem; font-weight: 600;">Nouvel entraînement</div>
                            </div>
                        </a>
                        <a href="/seances/create" class="card" style="text-decoration: none; color: var(--text);">
                            <div style="text-align: center;">
                                <div style="font-size: 2rem; margin-bottom: 8px;">📅</div>
                                <div style="font-size: 0.875rem; font-weight: 600;">Nouvelle séance</div>
                            </div>
                        </a>
                    @endif
                    
                    <a href="/seances" class="card" style="text-decoration: none; color: var(--text);">
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 8px;">��</div>
                            <div style="font-size: 0.875rem; font-weight: 600;">Voir planning</div>
                        </div>
                    </a>
                    
                    @if($user && $user->hasAnyRole(['president']))
                        <a href="/adherents" class="card" style="text-decoration: none; color: var(--text);">
                            <div style="text-align: center;">
                                <div style="font-size: 2rem; margin-bottom: 8px;">👥</div>
                                <div style="font-size: 0.875rem; font-weight: 600;">Gérer membres</div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
