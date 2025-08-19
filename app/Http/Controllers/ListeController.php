<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;

class ListeController extends Controller
{
    public function index(Request $request)
    {
        $eleves = Eleve::orderBy('estPrioritaire', 'desc')
            ->orderBy('dateInscription', 'desc')->paginate(10);
        return view('liste', compact('eleves'));
    }
}
