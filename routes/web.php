<?php

use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListeController::class, 'index'])->name('liste');
Route::get('/ajouter', [FormulaireController::class, 'index'])->name('ajouter');
Route::post('/ajouter', [FormulaireController::class,'store'])->name('ajouter.store');
