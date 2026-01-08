<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('uploader');
        
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filtrer selon les permissions de l'utilisateur
        $user = auth()->user();
        if (!$user->hasAnyRole(['president', 'responsable_planning'])) {
            if ($user->hasRole('entraineur')) {
                $query->whereIn('visible_par', ['tous', 'adherents_only', 'entraineurs_only']);
            } else {
                $query->whereIn('visible_par', ['tous', 'adherents_only']);
            }
        }
        
        $documents = $query->latest()->paginate(15);
        
        return view('documents.index-v2', compact('documents'));
    }

    public function create()
    {
        return view('documents.create-v2');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'fichier' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
            'categorie' => 'required|in:reglement,technique,administratif,autre',
            'visible_par' => 'required|in:tous,adherents_only,entraineurs_only,admin_only',
        ]);

        $fichierPath = $request->file('fichier')->store('documents', 'public');

        $document = Document::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'fichier' => $fichierPath,
            'categorie' => $validated['categorie'],
            'visible_par' => $validated['visible_par'],
            'upload_par' => auth()->id(),
        ]);

        // Notifier les utilisateurs selon la visibilité
        $usersToNotify = collect();
        
        switch ($validated['visible_par']) {
            case 'tous':
                $usersToNotify = \App\Models\User::where('id', '!=', auth()->id())->get();
                break;
            case 'adherents_only':
                $usersToNotify = \App\Models\User::whereHas('role', function($q) {
                    $q->whereIn('nom_role', ['membre', 'adherent']);
                })->where('id', '!=', auth()->id())->get();
                break;
            case 'entraineurs_only':
                $usersToNotify = \App\Models\User::whereHas('role', function($q) {
                    $q->whereIn('nom_role', ['entraineur', 'responsable_planning', 'president']);
                })->where('id', '!=', auth()->id())->get();
                break;
            case 'admin_only':
                $usersToNotify = \App\Models\User::whereHas('role', function($q) {
                    $q->whereIn('nom_role', ['president', 'responsable_planning']);
                })->where('id', '!=', auth()->id())->get();
                break;
        }

        foreach ($usersToNotify as $user) {
            $user->notify(new \App\Notifications\NewDocumentNotification($document));
        }

        return redirect()->route('documents.index')
            ->with('success', 'Document uploadé avec succès.');
    }

    public function show(Document $document)
    {
        $document->load('uploader');
        return view('documents.show-v2', compact('document'));
    }

    public function download(Document $document)
    {
        $document->incrementDownloads();
        return Storage::disk('public')->download($document->fichier, basename($document->fichier));
    }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->fichier);
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document supprimé avec succès.');
    }
}
