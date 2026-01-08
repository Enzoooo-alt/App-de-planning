@extends('layouts.app-v2')

@section('title', 'Conversation')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <nav style="margin-bottom: 1.5rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--lp-teal); text-decoration: none;">Tableau de bord</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <a href="{{ route('messages.index') }}" style="color: var(--lp-teal); text-decoration: none;">Messages</a>
        <span style="margin: 0 0.5rem; color: var(--lp-text-muted);">/</span>
        <span style="color: var(--lp-text-muted);">Conversation</span>
    </nav>

    <!-- En-tête de conversation -->
    <div class="card" style="margin-bottom: 1.5rem; background: linear-gradient(135deg, var(--lp-navy), var(--lp-teal)); color: white;">
        <div style="padding: var(--lp-space-lg); display: flex; align-items: center; gap: 1rem;">
            @php 
                $autresParticipants = $conversation->participants->where('id', '!=', auth()->id());
            @endphp
            
            @if($conversation->is_groupe)
                <div class="avatar" style="background: white; color: var(--lp-navy); width: 3rem; height: 3rem;">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            @else
                @php $autre = $autresParticipants->first(); @endphp
                <div class="avatar" style="width: 3rem; height: 3rem; font-size: 1.25rem; background: white; color: var(--lp-navy);">
                    {{ strtoupper(substr($autre->name ?? 'U', 0, 1)) }}
                </div>
            @endif
            
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">
                    @if($conversation->titre)
                        {{ $conversation->titre }}
                    @elseif($conversation->is_groupe)
                        Groupe ({{ $conversation->participants->count() }} membres)
                    @else
                        {{ $autresParticipants->first()->name ?? 'Conversation' }}
                    @endif
                </h1>
                <div style="font-size: 0.875rem; opacity: 0.9;">
                    @if($conversation->is_groupe)
                        {{ $autresParticipants->pluck('name')->join(', ') }}
                    @else
                        {{ $autresParticipants->first()->role->nom_role ?? 'Membre' }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <div style="padding: var(--lp-space-lg); max-height: 500px; overflow-y: auto;" id="messages-container">
            @forelse($conversation->messages as $message)
                @php $isOwn = $message->user_id == auth()->id(); @endphp
                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; {{ $isOwn ? 'flex-direction: row-reverse;' : '' }}">
                    <div style="flex-shrink: 0;">
                        <div class="avatar" style="{{ $isOwn ? 'background: linear-gradient(135deg, var(--lp-teal), var(--lp-navy));' : '' }}">
                            {{ strtoupper(substr($message->auteur->name, 0, 1)) }}
                        </div>
                    </div>
                    
                    <div style="flex: 1; max-width: 70%;">
                        @if(!$isOwn)
                            <div style="font-weight: 600; color: var(--lp-navy); font-size: 0.875rem; margin-bottom: 0.25rem;">
                                {{ $message->auteur->name }}
                            </div>
                        @endif
                        
                        <div style="background: {{ $isOwn ? 'linear-gradient(135deg, var(--lp-teal), var(--lp-navy))' : 'var(--lp-bg-ocean)' }}; 
                                    color: {{ $isOwn ? 'white' : 'var(--lp-navy)' }}; 
                                    padding: 1rem; 
                                    border-radius: var(--lp-radius); 
                                    word-break: break-word;
                                    line-height: 1.5;">
                            {{ $message->contenu }}
                        </div>
                        
                        <div style="font-size: 0.75rem; color: var(--lp-text-muted); margin-top: 0.25rem; {{ $isOwn ? 'text-align: right;' : '' }}">
                            {{ $message->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem; color: var(--lp-text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">💬</div>
                    <div>Aucun message dans cette conversation</div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Formulaire de réponse -->
    <div class="card">
        <form method="POST" action="{{ route('messages.send', $conversation) }}" style="padding: var(--lp-space-lg);">
            @csrf
            
            <div class="form-group" style="margin-bottom: 1rem;">
                <textarea class="form-input @error('contenu') is-invalid @enderror" 
                          name="contenu" 
                          rows="3" 
                          placeholder="Écrivez votre message..." 
                          required 
                          style="resize: vertical;">{{ old('contenu') }}</textarea>
                @error('contenu')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Retour
                </a>
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

<script>
// Auto-scroll vers le bas des messages
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('messages-container');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
});
</script>
@endsection
