@extends('layouts.app-v2')

@section('title', 'Calendrier des séances')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <!-- En-tête -->
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: var(--lp-navy); margin-bottom: 0.5rem;">
            📅 Calendrier des séances
        </h1>
        <p style="color: var(--lp-text-muted);">
            Visualisez toutes les séances du club par mois
        </p>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid md:grid-cols-3 gap-6" style="margin-bottom: 2rem;">
        <div class="card" style="border-left: 4px solid var(--lp-teal);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-teal), var(--lp-teal-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Total ce mois</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['total_seances'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-success);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, var(--lp-success), #22c55e); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">À venir</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['seances_a_venir'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-left: 4px solid var(--lp-text-muted);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #94a3b8, #64748b); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div>
                    <div style="font-size: 0.875rem; color: var(--lp-text-muted); margin-bottom: 0.25rem;">Passées</div>
                    <div style="font-size: 1.875rem; font-weight: 700; color: var(--lp-navy);">
                        {{ $stats['seances_passees'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation mois -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <div style="display: flex; justify-content: between; align-items: center; padding: 1rem;">
            <a href="{{ route('calendrier.index', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" 
               class="btn btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                {{ $prevMonth->format('M Y') }}
            </a>
            
            <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--lp-navy); margin: 0;">
                {{ $currentDate->locale('fr')->isoFormat('MMMM YYYY') }}
            </h2>
            
            <a href="{{ route('calendrier.index', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" 
               class="btn btn-secondary">
                {{ $nextMonth->format('M Y') }}
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>
    </div>

    <!-- Vue calendrier -->
    <div class="card">
        <div style="padding: 1.5rem;">
            <!-- Jours de la semaine -->
            <div class="grid grid-cols-7 gap-2" style="margin-bottom: 1rem;">
                @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $day)
                    <div style="text-align: center; font-weight: 600; color: var(--lp-navy); padding: 0.5rem; background: var(--lp-bg-ocean); border-radius: var(--lp-radius);">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <!-- Grille calendrier -->
            <div class="grid grid-cols-7 gap-2">
                @php
                    // Get first day of month (1=Monday, 7=Sunday)
                    $firstDayOfWeek = $startDate->copy()->dayOfWeekIso;
                    
                    // Add empty cells for days before first day of month
                    for ($i = 1; $i < $firstDayOfWeek; $i++) {
                        echo '<div style="min-height: 100px; background: #f8fafc; border-radius: var(--lp-radius);"></div>';
                    }
                    
                    // Loop through all days of the month
                    $currentDay = $startDate->copy();
                    while ($currentDay <= $endDate) {
                        $isToday = $currentDay->isToday();
                        $isPast = $currentDay->isPast() && !$isToday;
                        $dateString = $currentDay->format('Y-m-d');
                        
                        // Get seances for this day
                        $daySeances = $seances->filter(function($seance) use ($dateString) {
                            return $seance->date_seance === $dateString;
                        });
                @endphp
                
                <div style="min-height: 100px; padding: 0.5rem; border: 2px solid {{ $isToday ? 'var(--lp-teal)' : 'var(--lp-border)' }}; border-radius: var(--lp-radius); background: {{ $isPast ? '#f8fafc' : 'white' }};">
                    <!-- Day number -->
                    <div style="margin-bottom: 0.5rem;">
                        <span style="display: inline-block; width: 1.75rem; height: 1.75rem; line-height: 1.75rem; text-align: center; border-radius: 50%; font-weight: 600; font-size: 0.875rem; 
                            {{ $isToday ? 'background: var(--lp-teal); color: white;' : 'color: var(--lp-navy);' }}">
                            {{ $currentDay->day }}
                        </span>
                    </div>
                    
                    <!-- Seances for this day -->
                    @foreach($daySeances as $seance)
                        <a href="{{ route('seances.show', $seance) }}" 
                           style="display: block; padding: 0.25rem 0.5rem; margin-bottom: 0.25rem; font-size: 0.75rem; border-radius: calc(var(--lp-radius) / 2); text-decoration: none; transition: all var(--lp-transition-fast);
                           @if($seance->entrainement)
                               @if($seance->entrainement->niveau === 'Débutant')
                                   background: var(--lp-bg-success); color: var(--lp-success);
                               @elseif($seance->entrainement->niveau === 'Intermédiaire')
                                   background: var(--lp-bg-warning); color: var(--lp-warning);
                               @elseif($seance->entrainement->niveau === 'Avancé')
                                   background: var(--lp-bg-danger); color: var(--lp-danger);
                               @else
                                   background: var(--lp-bg-ocean); color: var(--lp-teal);
                               @endif
                           @else
                               background: var(--lp-bg-ocean); color: var(--lp-teal);
                           @endif"
                           onmouseover="this.style.opacity='0.8'"
                           onmouseout="this.style.opacity='1'">
                            <div style="font-weight: 600;">
                                {{ \Carbon\Carbon::parse($seance->heure_debut)->format('H:i') }}
                            </div>
                            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $seance->entrainement->titre ?? 'Sans programme' }}">
                                {{ Str::limit($seance->entrainement->titre ?? 'Sans programme', 15) }}
                            </div>
                        </a>
                    @endforeach
                </div>
                
                @php
                        $currentDay->addDay();
                    }
                @endphp
            </div>
        </div>
    </div>

    <!-- Légende -->
    <div class="card" style="margin-top: 1.5rem;">
        <div style="padding: 1rem;">
            <h3 style="font-size: 1rem; font-weight: 600; color: var(--lp-navy); margin-bottom: 1rem;">
                🎨 Légende des couleurs
            </h3>
            <div class="grid md:grid-cols-4 gap-4">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 1rem; height: 1rem; border-radius: 50%; background: var(--lp-success);"></div>
                    <span style="font-size: 0.875rem; color: var(--lp-text);">Débutant</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 1rem; height: 1rem; border-radius: 50%; background: var(--lp-warning);"></div>
                    <span style="font-size: 0.875rem; color: var(--lp-text);">Intermédiaire</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 1rem; height: 1rem; border-radius: 50%; background: var(--lp-danger);"></div>
                    <span style="font-size: 0.875rem; color: var(--lp-text);">Avancé</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 1rem; height: 1rem; border-radius: 50%; background: var(--lp-teal);"></div>
                    <span style="font-size: 0.875rem; color: var(--lp-text);">Autre / Compétition</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action rapide -->
    @if(auth()->user()->hasAnyRole(['president', 'responsable_planning', 'entraineur']))
        <div style="margin-top: 2rem; text-align: center;">
            <a href="{{ route('seances.create') }}" class="btn btn-primary" style="font-size: 1.125rem; padding: 0.75rem 2rem;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Planifier une nouvelle séance
            </a>
        </div>
    @endif
</div>
@endsection
