<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Liste des rôles autorisés
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                           ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $user = auth()->user();
        
        if (!$user->role) {
            abort(403, 'Votre compte n\'a pas de rôle assigné.');
        }

        if (!in_array($user->role->nom_role, $roles)) {
            abort(403, 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.');
        }

        return $next($request);
    }
}

