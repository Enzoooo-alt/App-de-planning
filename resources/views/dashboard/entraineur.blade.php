<!-- Dashboard Entraîneur -->
<style>
    .trainer-session {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    .trainer-session:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .trainer-session.blue { border-left-color: var(--brand); }
    .trainer-session.green { border-left-color: var(--success); }
    .trainer-session.purple { border-left-color: var(--brand-dark); }
    .trainer-session.orange { border-left-color: var(--warning); }
</style>

<div class="grid cards mb-8">
    <!-- Mes séances cette semaine -->
    <div class="dashboard-card">
        <div class="dashboard-header">
            <h3 class="h3">
                <span style="font-size: 1.5rem; margin-right: 12px;">🏊‍♂️</span>
                Mes séances cette semaine
            </h3>
        </div>
        <div class="dashboard-content">
            @if($data['mes_seances_semaine']->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($data['mes_seances_semaine'] as $seance)
                        <div class="trainer-session blue" style="display: flex; justify-content: space-between; align-items: center; padding: 16px; background: rgba(var(--brand-rgb), 0.05); border-radius: var(--radius); box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <div style="flex: 1;">
                                <p style="font-weight: 600; color: var(--brand-dark);">{{ $seance->entrainement->titre ?? 'Entraînement' }}</p>
                                <p style="font-size: 0.875rem; color: var(--brand); display: flex; align-items: center; margin-top: 4px;">
                                    <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $seance->date_seance->format('d/m/Y') }} - {{ $seance->heure_debut }} à {{ $seance->heure_fin }}
                                </p>
                            </div>
                            <span class="badge" style="padding: 6px 12px; background: rgba(var(--brand-rgb), 0.2); color: var(--brand-dark); font-size: 0.75rem; font-weight: 600; border-radius: 50px;">Assigné</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center" style="padding: 32px 0;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 16px; color: var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p style="color: var(--muted);">Aucune séance assignée cette semaine</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Prochaines séances -->
    <div class="dashboard-card">
        <div class="dashboard-content">
            <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
                <span style="font-size: 1.5rem; margin-right: 12px;">📅</span>
                Prochaines séances
            </h3>
            @if($data['prochaines_seances']->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($data['prochaines_seances'] as $seance)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(var(--success-rgb), 0.1); border-radius: var(--radius);">
                            <div>
                                <p style="font-weight: 500; color: var(--success-dark);">{{ $seance->entrainement->titre ?? 'Entraînement' }}</p>
                                <p style="font-size: 0.875rem; color: var(--success);">{{ $seance->date_seance->format('d/m/Y') }} - {{ $seance->heure_debut }}</p>
                            </div>
                            <span style="font-size: 0.75rem; color: var(--success);">
                                {{ $seance->date_seance->diffForHumans() }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center" style="color: var(--muted); padding: 32px 0;">Aucune séance programmée</p>
            @endif
        </div>
    </div>
</div>

<!-- Fonctionnalités de l'Entraîneur -->
<div class="dashboard-card" style="margin-bottom: 24px;">
    <div class="dashboard-content">
        <h3 class="h3" style="margin-bottom: 16px; display: flex; align-items: center;">
            <span style="font-size: 1.5rem; margin-right: 12px;">🔧</span>
            Mes outils d'entraîneur
        </h3>
        
        <div class="grid cards">
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <h4 style="font-weight: 600; color: var(--text);">Gestion personnelle</h4>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">🔐 Connexion pour accéder au planning</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">🔗 Cliquer sur lien "mot de passe oublié"</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">📅 Visualiser entraînements sur période</span>
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                <h4 style="font-weight: 600; color: var(--text);">Collaboration</h4>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">❌ Signaler indisponibilité pour entraînement</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">🔄 Échanger entraînement avec collègue</span>
                    </div>
                    <div class="feature-item" style="width: 100%; text-align: left; padding: 12px; background: rgba(14, 165, 233, 0.1); border-radius: var(--radius); transition: all 0.2s ease; cursor: pointer;"
                         onmouseover="this.style.background='rgba(14, 165, 233, 0.15)'" 
                         onmouseout="this.style.background='rgba(14, 165, 233, 0.1)'">
                        <span style="font-size: 0.875rem;">📋 Voir entraînements en calendrier</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border);">
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white; border-radius: var(--radius); cursor: pointer; transition: all 0.2s ease;"
                     onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">📋</span>
                    <div style="text-align: left;">
                        <p style="font-weight: 500; margin: 0;">Mon planning</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Voir mes séances</p>
                    </div>
                </div>
                
                <div class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--warning) 0%, #f59e0b 100%); color: white; border-radius: var(--radius); cursor: pointer; transition: all 0.2s ease;"
                     onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">❌</span>
                    <div style="text-align: left;">
                        <p style="font-weight: 500; margin: 0;">Indisponibilité</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Signaler absence</p>
                    </div>
                </div>
                
                <div class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, var(--success) 0%, #059669 100%); color: white; border-radius: var(--radius); cursor: pointer; transition: all 0.2s ease;"
                     onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">🔄</span>
                    <div style="text-align: left;">
                        <p style="font-weight: 500; margin: 0;">Échanger</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Avec collègue</p>
                    </div>
                </div>
                
                <div class="action-card" style="display: flex; align-items: center; padding: 16px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border-radius: var(--radius); cursor: pointer; transition: all 0.2s ease;"
                     onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    <span style="font-size: 1.25rem; margin-right: 12px;">➕</span>
                    <div style="text-align: left;">
                        <p style="font-weight: 500; margin: 0;">Google Agenda</p>
                        <p style="font-size: 0.75rem; margin: 2px 0 0; opacity: 0.9;">Ajouter auto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
