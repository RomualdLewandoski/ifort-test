<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EleveController extends Controller
{
    public function toggleStar(Eleve $eleve, Request $request)
    {
        try {
            $eleve->update(['estPrioritaire' => ! $eleve->estPrioritaire]);
            return redirect()->route('liste', $request->query());
        } catch (\Throwable $e) {
            Log::error('Erreur de changement priorité ', [
                'id' => $eleve->id,
                'message : ' => $e->getMessage(),
                'stacktrace : ' => $e->getTrace()
            ]);
            return redirect()
                ->route('liste', $request->query())
                ->withErrors(['error' => 'Erreur lors de la mise à jour de la priorité.']);
        }
    }
}
