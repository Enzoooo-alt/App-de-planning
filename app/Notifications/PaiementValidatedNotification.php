<?php

namespace App\Notifications;

use App\Models\Paiement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaiementValidatedNotification extends Notification
{
    use Queueable;

    protected $paiement;

    /**
     * Create a new notification instance.
     */
    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement;
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
            'type' => 'paiement_validated',
            'paiement_id' => $this->paiement->id,
            'montant' => $this->paiement->montant,
            'type' => $this->paiement->type,
            'type_label' => $this->paiement->type_label,
            'date_paiement' => $this->paiement->date_paiement->format('d/m/Y'),
            'url' => route('paiements.show', $this->paiement),
