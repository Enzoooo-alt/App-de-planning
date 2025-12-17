<!-- Dashboard Président -->
<div class="grid lg:grid-cols-2 mb-8">
    <!-- Activité récente -->
    <div class="dashboard-card">
        <div class="dashboard-header" style="background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);">
            <h3 style="font-size: 1.125rem; margin: 0; display: flex; align-items: center;">
                <span style="margin-right: 8px;">📊</span>
                Activité récente
            </h3>
        </div>
        <div class="space-y-4">
            <div class="metric-card" style="background: #d1fae5; border-left-color: #10b981;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 600; color: #065f46;">Nouveaux membres cette semaine</div>
                        <div style="font-size: 0.875rem; color: #047857;">Croissance du club</div>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #10b981;">
                        {{ $data['recent_activities']['nouveaux_membres_semaine'] }}
                    </div>
                </div>
            </div>
            <div class="metric-card" style="background: #dbeafe; border-left-color: #3b82f6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 600; color: #1e3a8a;">Entraînements actifs</div>
                        <div style="font-size: 0.875rem; color: #1d4ed8;">Avec séances programmées</div>
                    </div>
                    <div style="font-size: 2rem; font-weight: 700; color: #3b82f6;">
                        {{ $data['recent_activities']['entrainements_actifs'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Répartition par rôles -->
    <div class="dashboard-card">
        <div class="dashboard-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
            <h3 style="font-size: 1.125rem; margin: 0; display: flex; align-items: center;">
                <span style="margin-right: 8px;">👥</span>
                Répartition par rôles
            </h3>
        </div>
        <div class="space-y-4">
            @foreach($data['members_by_role'] as $role)
                <div class="metric-card">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center;">
                            <div style="width: 16px; height: 16px; border-radius: 50%; margin-right: 12px;
                                @if($role->nom_role === 'president') background: #dc2626;
                                @elseif($role->nom_role === 'responsable_planning') background: #f59e0b;
                                @elseif($role->nom_role === 'entraineur') background: #3b82f6;
                                @else background: #10b981;
                                @endif
                            "></div>
                            <span style="font-weight: 600; color: var(--text);">{{ ucfirst(str_replace('_', ' ', $role->nom_role)) }}</span>
                        </div>
                        <span style="font-size: 1.5rem; font-weight: 700; color: var(--text);">{{ $role->users_count }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Fonctionnalités du Président -->
<div class="dashboard-card mb-6">
    <div class="dashboard-header" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
        <h3 style="font-size: 1.125rem; margin: 0; display: flex; align-items: center;">
            <span style="margin-right: 8px;">🔧</span>
            Gestion du club
        </h3>
    </div>
    
    <!-- Selon l'image fournie -->
    <div class="grid md:grid-cols-2">
        <div class="space-y-4">
            <h4 style="font-weight: 600; color: var(--text); border-bottom: 1px solid var(--border); padding-bottom: 8px;">Gestion des mots de passe et sécurité</h4>
            <div class="space-y-4">
                <div class="metric-card" style="background: #fef3c7; border-left-color: #f59e0b;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #92400e;">🔐 Respect du critère "confidentialité"</span>
                        <span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Actif</span>
                    </div>
                </div>
                <div class="metric-card" style="background: #fef3c7; border-left-color: #f59e0b;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #92400e;">�� Critère de sécurité "non-répudiation"</span>
                        <span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Actif</span>
                    </div>
                </div>
                <div class="metric-card" style="background: #fef3c7; border-left-color: #f59e0b;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #92400e;">🛡️ Authentification renforcée</span>
                        <span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Actif</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="space-y-4">
            <h4 style="font-weight: 600; color: var(--text); border-bottom: 1px solid var(--border); padding-bottom: 8px;">Gestion des membres</h4>
            <div class="space-y-4">
                <a href="/adherents" class="card" style="text-decoration: none; color: var(--text); display: block;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="font-size: 1.5rem;">👤</div>
                        <div>
                            <div style="font-weight: 600;">Gérer les adhérents</div>
                            <div style="font-size: 0.875rem; color: var(--muted);">Ajouter, modifier, supprimer</div>
                        </div>
                    </div>
                </a>
                <a href="/entraineurs" class="card" style="text-decoration: none; color: var(--text); display: block;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="font-size: 1.5rem;">🏊‍♂️</div>
                        <div>
                            <div style="font-weight: 600;">Gérer les entraîneurs</div>
                            <div style="font-size: 0.875rem; color: var(--muted);">Attribution des rôles</div>
                        </div>
                    </div>
                </a>
                <a href="/entrainements" class="card" style="text-decoration: none; color: var(--text); display: block;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="font-size: 1.5rem;">📋</div>
                        <div>
                            <div style="font-weight: 600;">Superviser les entraînements</div>
                            <div style="font-size: 0.875rem; color: var(--muted);">Validation et approbation</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
