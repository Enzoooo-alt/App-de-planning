<?php

namespace App\Notifications;

use App\Models\Actualite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewActualiteNotification extends Notification
{
    use Queueable;

    protected $actualite;

    /**
     * Create a new notification instance.
     */
    public function __construct(Actualite $actualite)
    {
        $this->actualite = $actualite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_actualite',
            'actualite_id' => $this->actualite->id,
            'titre' => $this->actualite->titre,
            'contenu_preview' => \Illuminate\Support\Str::limit(strip_tags($this->actualite->contenu), 100),
            'auteur_name' => $this->actualite->auteur->name ?? 'Lyon Palme',
            'url' => route('actualites.show', $this->actualite),
