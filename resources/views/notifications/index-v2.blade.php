@extends('layouts.app-v2')

@section('title', 'Notifications')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
                🔔 Notifications
            </h1>
            <p style="color: var(--lp-text-muted);">
                {{ $unreadCount }} notification(s) non lue(s)
            </p>
        </div>
        @if($unreadCount > 0)
            <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Tout marquer comme lu
                </button>
            </form>
        @endif
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

    <!-- Liste des notifications -->
    <div class="card">
        @if($notifications->count() > 0)
            <div style="divide-y divide-gray-200;">
                @foreach($notifications as $notification)
                    <div style="padding: 1.5rem; {{ $notification->read_at ? 'opacity: 0.6;' : '' }} transition: all var(--lp-transition-normal);">
                        <div style="display: flex; gap: 1rem;">
                            <!-- Icône -->
                            <div style="flex-shrink: 0;">
                                <div style="width: 3rem; height: 3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                                    background: {{ $notification->read_at ? 'var(--lp-bg)' : 'var(--lp-bg-ocean)' }};">
                                    @php
                                        $type = $notification->data['type'] ?? 'default';
                                        $iconColor = $notification->read_at ? 'var(--lp-text-muted)' : 'var(--lp-teal)';
                                    @endphp
                                    @if($type === 'new_message')
                                        <span style="font-size: 1.5rem;">💬</span>
                                    @elseif($type === 'paiement_validated')
                                        <span style="font-size: 1.5rem;">💰</span>
                                    @elseif($type === 'new_document')
                                        <span style="font-size: 1.5rem;">📄</span>
                                    @elseif($type === 'new_actualite')
                                        <span style="font-size: 1.5rem;">📰</span>
                                    @elseif($notification->data['icon'] ?? null === 'calendar')
                                        <svg width="24" height="24" fill="none" stroke="{{ $iconColor }}" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    @elseif($notification->data['icon'] ?? null === 'megaphone')
                                        <svg width="24" height="24" fill="none" stroke="var(--lp-navy)" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M3 11l18-5v12L3 13v-2z"></path>
                                            <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"></path>
                                        </svg>
                                    @else
                                        <svg width="24" height="24" fill="none" stroke="{{ $iconColor }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                    <h3 style="font-size: 1rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                                        @if($type === 'new_message')
                                            💬 Nouveau message de {{ $notification->data['auteur_name'] ?? 'Inconnu' }}
                                        @elseif($type === 'paiement_validated')
                                            ✅ Paiement validé - {{ $notification->data['type_label'] ?? 'Paiement' }}
                                        @elseif($type === 'new_document')
                                            📄 Nouveau document : {{ $notification->data['titre'] ?? 'Document' }}
                                        @elseif($type === 'new_actualite')
                                            📰 Nouvelle actualité : {{ $notification->data['titre'] ?? 'Actualité' }}
                                        @else
                                            {{ $notification->data['message'] ?? 'Notification' }}
                                        @endif
                                    </h3>
                                    <span style="font-size: 0.875rem; color: var(--lp-text-muted); white-space: nowrap; margin-left: 1rem;">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <p style="color: var(--lp-text-muted); margin-bottom: 0.75rem; font-size: 0.875rem;">
                                    @if($type === 'new_message')
                                        {{ $notification->data['contenu_preview'] ?? 'Nouveau message' }}
                                    @elseif($type === 'paiement_validated')
                                        Montant : {{ number_format($notification->data['montant'] ?? 0, 2) }}€ - Date : {{ $notification->data['date_paiement'] ?? '' }}
                                    @elseif($type === 'new_document')
                                        {{ $notification->data['categorie'] ?? '' }} - Partagé par {{ $notification->data['uploader_name'] ?? 'Inconnu' }}
                                    @elseif($type === 'new_actualite')
                                        {{ $notification->data['contenu_preview'] ?? '' }}
                                    @elseif(isset($notification->data['titre']))
                                        {{ $notification->data['titre'] }}
                                    @endif
                                </p>

                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                    @if(isset($notification->data['url']))
                                        <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary"
                                           onclick="event.preventDefault(); 
                                                    fetch('{{ route('notifications.read', $notification->id) }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
                                                    .then(() => window.location.href = '{{ $notification->data['url'] }}');">
                                            Voir
                                        </a>
                                    @elseif(!$notification->read_at)
                                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Marquer comme lu
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-ghost" style="color: var(--lp-danger);">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Badge non lu -->
                            @if(!$notification->read_at)
                                <div style="flex-shrink: 0;">
                                    <div style="width: 0.75rem; height: 0.75rem; background: var(--lp-teal); border-radius: 50%;"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div style="padding: 1rem; border-top: 1px solid var(--lp-border);">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <svg width="64" height="64" fill="none" stroke="var(--lp-text-muted)" stroke-width="2" viewBox="0 0 24 24" style="margin: 0 auto 1.5rem; opacity: 0.3;">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 0.5rem;">
                    Aucune notification
                </h3>
                <p style="color: var(--lp-text-muted);">
                    Vous êtes à jour !
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
