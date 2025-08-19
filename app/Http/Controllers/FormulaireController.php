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
 * Controlleur en charge du formulaire d'inscription.
 */
class FormulaireController extends Controller
{
    /**
     * Fonciton d'affichage du formulaire d'inscription.
     *
     * @return Factory|View|Application|object
     */
    public function index(): Factory|Application|View
    {
        return view('formulaire');
    }


    /**
     * Fonction d'enregistrement des données du formulaire.
     *
     * @param InscriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(InscriptionRequest $request): RedirectResponse|null
    {
        try{
            $data = $request->validated();
            Eleve::create($data);
            return redirect()->route('liste');
        }catch (\Throwable $e){
            Log::error("Echec lors de l'enregistrement de l'élève", [
                'message : ' => $e->getMessage(),
                'stacktrace : ' => $e->getTrace(),
                'payload : ' => $request->all()
            ]);
            abort(500, "Erreur lors de l'enregistrement de l'élève");
        }
    }
}
