<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListeController extends Controller
{
    public function index(Request $request)
    {
        //todo return front end here
        return view('liste');
    }
}
