@extends('layouts.app-v2')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- Breadcrumb -->
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Utilisateurs</span>
    </nav>

    <!-- En-tête avec action -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                Gestion des utilisateurs
            </h1>
            <p style="color: var(--lp-text-muted);">
                {{ $stats['total'] }} utilisateur(s) enregistré(s)
            </p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Créer un utilisateur
        </a>
    </div>

    <!-- Messages de feedback -->
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistiques par rôle -->
    <div class="grid md:grid-cols-4 gap-6" style="margin-bottom: 2rem;">
        @foreach($stats['par_role'] as $role)
            <div class="card" style="border-left: 4px solid 
                @if($role->nom_role === 'president') var(--lp-danger)
                @elseif($role->nom_role === 'responsable_planning') var(--lp-warning)
                @elseif($role->nom_role === 'entraineur') var(--lp-teal)
                @else var(--lp-success)
                @endif
            ;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">
                            {{ ucfirst(str_replace('_', ' ', $role->nom_role)) }}
                        </div>
                        <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                            {{ $role->users_count }}
                        </div>
                    </div>
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;
                        background: 
                        @if($role->nom_role === 'president') var(--lp-bg-danger)
                        @elseif($role->nom_role === 'responsable_planning') var(--lp-bg-warning)
                        @elseif($role->nom_role === 'entraineur') var(--lp-bg-ocean)
                        @else var(--lp-bg-success)
                        @endif
                    ;">
                        <svg width="20" height="20" fill="none" stroke="
                            @if($role->nom_role === 'president') var(--lp-danger)
                            @elseif($role->nom_role === 'responsable_planning') var(--lp-warning)
                            @elseif($role->nom_role === 'entraineur') var(--lp-teal)
                            @else var(--lp-success)
                            @endif
                        " stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Table des utilisateurs -->
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.25rem; font-weight: 600; color: white; margin: 0;">
                Liste des utilisateurs
            </h2>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg, var(--lp-teal), var(--lp-marine)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.875rem;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: var(--lp-navy);">
                                            {{ $user->name }}
                                        </div>
                                        @if($user->first_name || $user->last_name)
                                            <div style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="color: var(--lp-text-muted);">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="badge badge-
                                    @if($user->role && $user->role->nom_role === 'president') danger
                                    @elseif($user->role && $user->role->nom_role === 'responsable_planning') warning
                                    @elseif($user->role && $user->role->nom_role === 'entraineur') teal
                                    @else success
                                    @endif
                                ">
                                    {{ $user->role ? ucfirst(str_replace('_', ' ', $user->role->nom_role)) : 'Aucun' }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 0.875rem; color: var(--lp-text-muted);">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-ghost" title="Voir">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-ghost" title="Modifier">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-ghost" title="Supprimer" 
                                                    style="color: var(--lp-danger);">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="btn btn-sm btn-ghost" style="opacity: 0.3; cursor: not-allowed;" title="Vous ne pouvez pas supprimer votre propre compte">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                                <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin: 0 auto 1rem; display: block; opacity: 0.3;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <p style="margin: 0;">Aucun utilisateur trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div style="padding: 1rem; border-top: 1px solid var(--lp-border);">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
