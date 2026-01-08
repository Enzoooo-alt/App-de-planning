<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = auth()->user()
            ->belongsToMany(Conversation::class, 'conversation_user')
            ->with(['dernierMessage.auteur', 'participants'])
            ->withPivot('derniere_lecture')
            ->latest('updated_at')
            ->get();
        
        return view('messages.index-v2', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        // Vérifier que l'utilisateur fait partie de la conversation
        if (!$conversation->participants->contains(auth()->id())) {
            abort(403, 'Accès non autorisé à cette conversation.');
        }
        
        $conversation->load(['messages.auteur', 'participants']);
        
        // Marquer comme lu
        $conversation->participants()
            ->updateExistingPivot(auth()->id(), ['derniere_lecture' => now()]);
        
        return view('messages.show-v2', compact('conversation'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();
        
        return view('messages.create-v2', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinataires' => 'required|array|min:1',
            'destinataires.*' => 'exists:users,id',
            'contenu' => 'required|string|max:5000',
            'titre' => 'nullable|string|max:255',
        ]);

        $conversation = Conversation::create([
            'titre' => $validated['titre'] ?? null,
            'is_groupe' => count($validated['destinataires']) > 1,
        ]);

        // Ajouter l'auteur et les destinataires
        $participants = array_merge($validated['destinataires'], [auth()->id()]);
        $conversation->participants()->attach($participants);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => auth()->id(),
            'contenu' => $validated['contenu'],
        ]);

        // Créer des notifications pour chaque destinataire
        foreach ($validated['destinataires'] as $userId) {
            $user = User::find($userId);
            $user->notify(new \App\Notifications\NewMessageNotification($message, $conversation));
        }

        return redirect()->route('messages.show', $conversation)
            ->with('success', 'Message envoyé avec succès.');
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        if (!$conversation->participants->contains(auth()->id())) {
            abort(403);
        }

        $validated = $request->validate([
            'contenu' => 'required|string|max:5000',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => auth()->id(),
            'contenu' => $validated['contenu'],
        ]);

        // Notifier les autres participants
        $otherParticipants = $conversation->participants->where('id', '!=', auth()->id());
        foreach ($otherParticipants as $user) {
            $user->notify(new \App\Notifications\NewMessageNotification($message, $conversation));
        }

        return redirect()->route('messages.show', $conversation);
    }

    public function unreadCount()
    {
        $count = 0;
        $conversations = auth()->user()
            ->belongsToMany(Conversation::class, 'conversation_user')
            ->withPivot('derniere_lecture')
            ->get();
        
        foreach ($conversations as $conversation) {
            $lastRead = $conversation->pivot->derniere_lecture;
            $unreadMessages = Message::where('conversation_id', $conversation->id)
                ->where('user_id', '!=', auth()->id())
                ->when($lastRead, fn($q) => $q->where('created_at', '>', $lastRead))
                ->count();
            $count += $unreadMessages;
        }
        
        return response()->json(['count' => $count]);
    }
}
