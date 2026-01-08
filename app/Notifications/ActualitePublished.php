<?php

namespace App\Notifications;

use App\Models\Actualite;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ActualitePublished extends Notification
{
    use Queueable;

    public $actualite;

    public function __construct(Actualite $actualite)
    {
        $this->actualite = $actualite;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'actualite_id' => $this->actualite->id,
            'titre' => $this->actualite->titre,
            'categorie' => $this->actualite->categorie,
            'message' => 'Nouvelle actualité : ' . $this->actualite->titre,
            'icon' => 'megaphone',
            'color' => 'navy',
        ];
    }
}
