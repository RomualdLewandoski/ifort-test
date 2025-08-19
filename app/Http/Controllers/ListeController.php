<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;

class ListeController extends Controller
{
    public function index(Request $request)
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
