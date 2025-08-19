<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EleveController extends Controller
{
    public function toggleStar(Eleve $eleve, Request $request)
    {
        try {
            $eleve->update(['estPrioritaire' => !$eleve->estPrioritaire]);
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

    public function edit(Eleve $eleve)
    {
        return view('formulaire', compact('eleve'));
    }

    public function update(Eleve $eleve, InscriptionRequest $request)
    {
        try {
            $data = $request->validated();

            $eleve->update($data);

            return redirect()
                ->route('liste');
        } catch (\Throwable $e) {
            Log::error("Échec lors de la mise à jour de l'élève", [
                'id' => $eleve->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);

            abort(500, "Erreur lors de la mise à jour de l'élève");
        }
    }

    public function destroy(Eleve $eleve, Request $request)
    {
        try {
            $eleve->delete();
            return redirect()
                ->back();
        } catch (\Throwable $e) {
            Log::error("Echec lors de la suppression de l'élève", [
                'id' => $eleve->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()
                ->route('liste', $request->query())
                ->withErrors(['error' => "Erreur lors de la suppression de l'élève."]);
        }
    }
}
