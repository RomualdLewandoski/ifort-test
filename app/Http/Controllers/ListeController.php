<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlleur en charge de l'affichage de la liste des élèves.
 */
class ListeController extends Controller
{
    /**
     * Affiche la liste des élèves avec pagination et filtres.
     *
     * @param Request $request La requête avec les filtres
     * @return View La vue avec la liste des élèves
     */
    public function index(Request $request): View
    {
        $eleves = Eleve::query()
            ->search($request->input('query'))
            ->statut($request->input('statutInscription'))
            ->orderByDesc('estPrioritaire')
            ->orderByDesc('dateInscription')
            ->paginate(10)
            ->appends($request->query());
        return view('liste', compact('eleves'));
    }
}
