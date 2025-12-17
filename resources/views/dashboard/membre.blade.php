<!-- Dashboard Membre -->
<style>
    .member-session-card {
        transition: all 0.3s ease;
        border: 2px solid var(--border);
    }
    .member-session-card:hover {
        border-color: var(--brand);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="dashboard-card" style="margin-bottom: 24px;">
    <div class="dashboard-header" style="background: linear-gradient(135deg, var(--success) 0%, #059669 100%);">
        <h3 class="h3" style="color: white;">
            <span style="font-size: 1.5rem; margin-right: 12px;">🏊‍♀️</span>
            Prochaines séances disponibles
        </h3>
    </div>
    <div class="dashboard-content">
        
        @if($data['prochaines_seances']->count() > 0)
            <div class="grid cards">
                @foreach($data['prochaines_seances'] as $seance)
                    <div class="member-session-card" style="border-radius: var(--radius); padding: 20px; background: linear-gradient(135deg, white 0%, rgba(var(--brand-rgb), 0.02) 100%);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <h4 style="font-weight: 700; color: var(--text); font-size: 1.125rem; margin: 0;">{{ $seance->entrainement->titre ?? 'Entraînement' }}</h4>
                            <span class="badge" style="padding: 6px 12px; background: var(--brand); color: white; font-size: 0.75rem; font-weight: 600; border-radius: 50px;">
                                {{ $seance->date_seance->format('d/m') }}
                            </span>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                            <p style="font-size: 0.875rem; color: var(--muted-dark); display: flex; align-items: center; margin: 0;">
                                <svg style="width: 16px; height: 16px; margin-right: 8px; color: var(--brand);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $seance->date_seance->format('l d/m/Y') }}
                            </p>
                            <p style="font-size: 0.875rem; color: var(--muted-dark); display: flex; align-items: center; margin: 0;">
                                <svg style="width: 16px; height: 16px; margin-right: 8px; color: var(--brand);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $seance->heure_debut }} - {{ $seance->heure_fin }}
                            </p>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.75rem; color: var(--muted); font-weight: 500;">
                                {{ $seance->date_seance->diffForHumans() }}
                            </span>
                            <button class="button" style="padding: 8px 16px; font-size: 0.875rem; font-weight: 600; transition: all 0.2s ease;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                S'inscrire
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center" style="padding: 48px 0; background: rgba(var(--muted-rgb), 0.1); border-radius: var(--radius);">
                <span style="font-size: 3rem; margin-bottom: 16px; display: block;">🏊‍♀️</span>
                <p style="color: var(--muted); margin-bottom: 16px; font-size: 1rem;">Aucune séance programmée pour le moment</p>
                <p style="font-size: 0.875rem; color: var(--muted-light);">Les nouvelles séances apparaîtront ici dès qu'elles seront planifiées.</p>
            </div>
        @endif
    </div>
</div>

<!-- Informations pour les membres -->
<div class="grid cards mb-8">
    <!-- Mes informations -->
    <div class="dashboard-card">
        <div class="dashboard-content">
            <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
                <span style="font-size: 1.5rem; margin-right: 12px;">👤</span>
                Mes informations
            </h3>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(var(--muted-rgb), 0.1); border-radius: var(--radius);">
                    <span style="font-size: 0.875rem; font-weight: 500;">Statut</span>
                    <span class="badge" style="padding: 4px 8px; background: rgba(var(--success-rgb), 0.2); color: var(--success); font-size: 0.75rem; border-radius: var(--radius);">Membre actif</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(var(--muted-rgb), 0.1); border-radius: var(--radius);">
                    <span style="font-size: 0.875rem; font-weight: 500;">Membre depuis</span>
                    <span style="font-size: 0.875rem;">{{ $user->created_at->format('d/m/Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(var(--muted-rgb), 0.1); border-radius: var(--radius);">
                    <span style="font-size: 0.875rem; font-weight: 500;">Email</span>
                    <span style="font-size: 0.875rem;">{{ $user->email }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Activité récente -->
    <div class="dashboard-card">
        <div class="dashboard-content">
            <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
                <span style="font-size: 1.5rem; margin-right: 12px;">📈</span>
                Mon activité
            </h3>
            <div class="text-center" style="padding: 32px 0;">
                <span style="font-size: 3rem; margin-bottom: 16px; display: block;">🏊‍♀️</span>
                <p style="color: var(--muted); margin-bottom: 8px;">Bienvenue dans votre espace membre !</p>
                <p style="font-size: 0.875rem; color: var(--muted-light);">Votre historique d'activités apparaîtra ici.</p>
            </div>
        </div>
    </div>
</div>

<!-- Actions rapides pour les membres -->
<div class="dashboard-card">
    <div class="dashboard-content">
        <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
            <span style="font-size: 1.5rem; margin-right: 12px;">⚡</span>
            Actions rapides
        </h3>
        
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
            <a href="{{ route('seances.index') }}" class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%); color: white; border-radius: var(--radius); text-decoration: none; transition: all 0.2s ease;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                <span style="font-size: 1.25rem; margin-right: 12px;">📅</span>
                <div>
                    <p style="font-weight: 500; margin: 0;">Voir le planning</p>
                    <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Toutes les séances</p>
                </div>
            </a>
            
            <a href="{{ route('profile.edit') }}" class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--success) 0%, #059669 100%); color: white; border-radius: var(--radius); text-decoration: none; transition: all 0.2s ease;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                <span style="font-size: 1.25rem; margin-right: 12px;">⚙️</span>
                <div>
                    <p style="font-weight: 500; margin: 0;">Mon profil</p>
                    <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Modifier mes infos</p>
                </div>
            </a>
            
            <div class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border-radius: var(--radius); cursor: pointer; transition: all 0.2s ease;"
                 onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                <span style="font-size: 1.25rem; margin-right: 12px;">📞</span>
                <div style="text-align: left;">
                    <p style="font-weight: 500; margin: 0;">Contact</p>
                    <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Nous contacter</p>
                </div>
            </div>
        </div>
    </div>
</div>
