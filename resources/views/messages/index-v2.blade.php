@extends('layouts.app-v2')

@section('title', 'Messagerie')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Messages</span>
    </nav>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy);">
                💬 Messagerie
            </h1>
            <p style="color: var(--lp-text-muted);">Vos conversations avec les membres du club</p>
        </div>
        <a href="{{ route('messages.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            Nouveau message
        </a>
    </div>

    <div class="card">
        @forelse($conversations as $conversation)
            @php
                $autresParticipants = $conversation->participants->where('id', '!=', auth()->id());
                $dernierMsg = $conversation->dernierMessage;
                $lastRead = $conversation->pivot->derniere_lecture;
                $hasUnread = $dernierMsg && (!$lastRead || $dernierMsg->created_at > $lastRead) && $dernierMsg->user_id != auth()->id();
            @endphp
            <a href="{{ route('messages.show', $conversation) }}" 
               style="display: block; padding: var(--lp-space-lg); border-bottom: 1px solid var(--lp-border); text-decoration: none; transition: background 0.2s;"
               onmouseover="this.style.background='var(--lp-bg-ocean)'"
               onmouseout="this.style.background='white'">
                <div style="display: flex; gap: 1rem; align-items: start;">
                    <div style="flex-shrink: 0;">
                        @if($conversation->is_groupe)
                            <div class="avatar" style="background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal));">
                                <svg width="20" height="20" fill="white" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        @else
                            @php $autre = $autresParticipants->first(); @endphp
                            <div class="avatar">
                                {{ strtoupper(substr($autre->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.25rem;">
                            <div style="font-weight: 600; color: var(--lp-navy); {{ $hasUnread ? 'font-weight: 700;' : '' }}">
                                @if($conversation->titre)
                                    {{ $conversation->titre }}
                                @elseif($conversation->is_groupe)
                                    {{ $autresParticipants->pluck('name')->take(3)->join(', ') }}
                                @else
                                    {{ $autresParticipants->first()->name ?? 'Utilisateur' }}
                                @endif
                            </div>
                            @if($dernierMsg)
                                <div style="font-size: 0.75rem; color: var(--lp-text-muted); flex-shrink: 0;">
                                    {{ $dernierMsg->created_at->diffForHumans() }}
                                </div>
                            @endif
                        </div>
                        
                        @if($dernierMsg)
                            <div style="font-size: 0.875rem; color: var(--lp-text-muted); display: flex; align-items: center; gap: 0.5rem;">
                                <span style="font-weight: 500;">{{ $dernierMsg->auteur->name }}:</span>
                                <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; {{ $hasUnread ? 'font-weight: 600; color: var(--lp-navy);' : '' }}">
                                    {{ Str::limit($dernierMsg->contenu, 80) }}
                                </span>
                                @if($hasUnread)
                                    <span class="badge badge-primary" style="margin-left: auto;">●</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">💬</div>
                <div style="font-weight: 600;">Aucune conversation</div>
                <div style="margin-bottom: 1.5rem;">Commencez par envoyer un message</div>
                <a href="{{ route('messages.create') }}" class="btn btn-primary">
                    Nouveau message
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
