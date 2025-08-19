<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionRequest;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormulaireController extends Controller
{
    public function index()
    {
        return view('formulaire');
    }

    public function store(InscriptionRequest $request)
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
