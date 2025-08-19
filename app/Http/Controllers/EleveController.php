<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use App\Models\Eleve;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Controller en charge de la gestion des élèves.
 */
class EleveController extends Controller
{
    /**
     * Fonction en charge de marquer/retirer un élève comme prioritaire.
     *
     * @param Eleve $eleve
     * @param Request $request
     * @return RedirectResponse
     */
    public function toggleStar(Eleve $eleve, Request $request): RedirectResponse
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

    /**
     * Affichage du formulaire d'édition d'un élève.
     *
     * @param Eleve $eleve
     * @return Factory|View|Application
     */
    public function edit(Eleve $eleve): Factory|Application|View
    {
        return view('formulaire', compact('eleve'));
    }

    /**
     * Fonction en charge de sauvegarder les modifications d'un élève.
     *
     * @param Eleve $eleve
     * @param InscriptionRequest $request
     * @return RedirectResponse|null
     */
    public function update(Eleve $eleve, InscriptionRequest $request): RedirectResponse|null
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

    /**
     * Fonction en charge de supprimer un élève.
     *
     * @param Eleve $eleve
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Eleve $eleve, Request $request): RedirectResponse
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
