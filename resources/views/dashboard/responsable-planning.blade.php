<!-- Dashboard Responsable Planning -->
<style>
    .planning-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    .planning-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .planning-item.blue { border-left-color: var(--brand); }
    .planning-item.orange { border-left-color: var(--warning); }
    .planning-item.green { border-left-color: var(--success); }
    .planning-item.purple { border-left-color: var(--brand-dark); }
</style>

<div class="grid cards mb-8">
    <!-- Séances de la semaine prochaine -->
    <div class="dashboard-card">
        <div class="dashboard-header">
            <h3 class="h3">
                <span style="font-size: 1.5rem; margin-right: 12px;">📅</span>
                Séances semaine prochaine
            </h3>
        </div>
        <div class="dashboard-content">
            @if($data['seances_semaine_prochaine']->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($data['seances_semaine_prochaine'] as $seance)
                        <div class="planning-item blue" style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: rgba(var(--brand-rgb), 0.05); border-radius: var(--radius); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <div>
                                <p style="font-weight: 600; color: var(--brand-dark);">{{ $seance->entrainement->titre ?? 'Entraînement' }}</p>
                                <p style="font-size: 0.875rem; color: var(--brand); display: flex; align-items: center; margin-top: 4px;">
                                    <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $seance->date_seance->format('d/m/Y') }} - {{ $seance->heure_debut }} à {{ $seance->heure_fin }}
                                </p>
                            </div>
                            <div style="color: var(--brand);">
                                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center" style="padding: 32px 0;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p style="color: var(--muted);">Aucune séance programmée pour la semaine prochaine</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Entraînements sans séances -->
    <div class="dashboard-card">
        <div class="dashboard-header" style="background: linear-gradient(135deg, var(--warning) 0%, #f59e0b 100%);">
            <h3 class="h3" style="color: white;">
                <span style="font-size: 1.5rem; margin-right: 12px;">⚠️</span>
                Entraînements sans séances
            </h3>
        </div>
        <div class="dashboard-content">
            @if($data['entrainements_sans_seance']->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($data['entrainements_sans_seance'] as $entrainement)
                        <div class="planning-item orange" style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: rgba(245, 158, 11, 0.1); border-radius: var(--radius); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <div>
                                <p style="font-weight: 600; color: #b45309;">{{ $entrainement->titre }}</p>
                                <p style="font-size: 0.875rem; color: var(--warning);">Créé le {{ $entrainement->dateCreation->format('d/m/Y') }}</p>
                            </div>
                            <a href="{{ route('seances.create') }}?entrainement={{ $entrainement->idEntrainement }}" 
                               class="button" style="padding: 6px 12px; font-size: 0.75rem; background: var(--warning);">
                                Programmer
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center" style="color: var(--muted); padding: 32px 0;">Tous les entraînements ont des séances programmées</p>
            @endif
        </div>
    </div>
</div>

<!-- Fonctionnalités du Responsable Planning -->
<div class="dashboard-card" style="margin-bottom: 24px;">
    <div class="dashboard-content">
        <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
            <span style="font-size: 1.5rem; margin-right: 12px;">🔧</span>
            Gestion du planning
        </h3>
        
        <div class="grid cards">
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <h4 style="font-weight: 600; color: var(--text);">Gestion des entraînements</h4>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(var(--success-rgb), 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;" 
                         onmouseover="this.style.background='rgba(var(--success-rgb), 0.15)'" 
                         onmouseout="this.style.background='rgba(var(--success-rgb), 0.1)'">
                        <span style="font-size: 0.875rem;">✅ Créer un entraînement pour préparer une séance piscine</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(var(--success-rgb), 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(var(--success-rgb), 0.15)'" 
                         onmouseout="this.style.background='rgba(var(--success-rgb), 0.1)'">
                        <span style="font-size: 0.875rem;">✏️ Modifier ou supprimer un entraînement</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(var(--success-rgb), 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(var(--success-rgb), 0.15)'" 
                         onmouseout="this.style.background='rgba(var(--success-rgb), 0.1)'">
                        <span style="font-size: 0.875rem;">📊 Visualiser tous les entraînements sur une période</span>
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <h4 style="font-weight: 600; color: var(--text);">Authentification et accès</h4>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; background: rgba(var(--brand-rgb), 0.1); border-radius: var(--radius);">
                        <span style="font-size: 0.875rem;">🔐 Connexion pour accéder au planning</span>
                        <span class="badge" style="padding: 4px 8px; background: rgba(var(--success-rgb), 0.2); color: var(--success); font-size: 0.75rem; border-radius: var(--radius);">Actif</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; background: rgba(var(--brand-rgb), 0.1); border-radius: var(--radius);">
                        <span style="font-size: 0.875rem;">🔒 Changer mot de passe (confidentialité)</span>
                        <span class="badge" style="padding: 4px 8px; background: rgba(var(--success-rgb), 0.2); color: var(--success); font-size: 0.75rem; border-radius: var(--radius);">Disponible</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border);">
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                <a href="{{ route('entrainements.create') }}" class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--success) 0%, #059669 100%); color: white; border-radius: var(--radius); text-decoration: none; transition: all 0.2s ease;"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">➕</span>
                    <div>
                        <p style="font-weight: 500; margin: 0;">Créer entraînement</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Préparer séance piscine</p>
                    </div>
                </a>
                
                <a href="{{ route('seances.create') }}" class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%); color: white; border-radius: var(--radius); text-decoration: none; transition: all 0.2s ease;"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">📅</span>
                    <div>
                        <p style="font-weight: 500; margin: 0;">Programmer séance</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Nouvelle séance</p>
                    </div>
                </a>
                
                <a href="{{ route('entrainements.index') }}" class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border-radius: var(--radius); text-decoration: none; transition: all 0.2s ease;"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">📊</span>
                    <div>
                        <p style="font-weight: 500; margin: 0;">Voir planning</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Vue d'ensemble</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
