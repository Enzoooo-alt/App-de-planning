<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDocumentNotification extends Notification
{
    use Queueable;

    protected $document;

    /**
     * Create a new notification instance.
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
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
        $categories = [
            'reglement' => '📋 Règlement',
            'technique' => '🏊 Technique',
            'administratif' => '📄 Administratif',
            'autre' => '📁 Autre',
        ];

        return [
            'type' => 'new_document',
            'document_id' => $this->document->id,
            'titre' => $this->document->titre,
            'categorie' => $categories[$this->document->categorie] ?? $this->document->categorie,
            'uploader_name' => $this->document->uploader->name ?? 'Système',
            'url' => route('documents.show', $this->document),
