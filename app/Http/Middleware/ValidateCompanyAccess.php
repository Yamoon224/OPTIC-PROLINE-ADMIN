<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// app/Http/Middleware/ValidateCompanyAccess.php
class ValidateCompanyAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        // Vérifier que l'utilisateur accède aux données de sa propre entreprise
        if ($request->has('company_id') && $request->company_id != $user->company_id) {
            if ($user->role !== 'admin') {
                abort(403, 'Accès non autorisé.');
            }
        }

        return $next($request);
    }
}