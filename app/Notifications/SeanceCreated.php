<?php

namespace App\Notifications;

use App\Models\Seance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SeanceCreated extends Notification
{
    use Queueable;

    public $seance;

    public function __construct(Seance $seance)
    {
        $this->seance = $seance;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'seance_id' => $this->seance->id,
            'titre' => $this->seance->entrainement->titre ?? 'Nouvelle séance',
            'date' => $this->seance->date_seance,
            'heure_debut' => $this->seance->heure_debut,
            'lieu' => $this->seance->lieu,
            'message' => 'Une nouvelle séance a été planifiée',
            'icon' => 'calendar',
            'color' => 'teal',
        ];
    }
}
