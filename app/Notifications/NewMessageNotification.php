<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $conversation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message, Conversation $conversation)
    {
        $this->message = $message;
        $this->conversation = $conversation;
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
        $auteur = $this->message->auteur;
        $titre = $this->conversation->titre 
            ?? ($this->conversation->is_groupe ? 'Conversation de groupe' : $auteur->name);
        
        return [
            'type' => 'new_message',
            'message_id' => $this->message->id,
            'conversation_id' => $this->conversation->id,
            'auteur_name' => $auteur->name,
            'titre' => $titre,
            'contenu_preview' => \Illuminate\Support\Str::limit($this->message->contenu, 100),
            'url' => route('messages.show', $this->conversation),
        ];
    }
}
