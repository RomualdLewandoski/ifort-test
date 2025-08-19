<?php

use App\Http\Controllers\EleveController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListeController::class, 'index'])->name('liste');
Route::get('/ajouter', [FormulaireController::class, 'index'])->name('ajouter');
Route::post('/ajouter', [FormulaireController::class,'store'])->name('ajouter.store');
Route::prefix('eleve')->name('eleve.')->group(function () {
   Route::patch('/star/{eleve}', [EleveController::class, 'toggleStar'])->name('star');
   Route::get('/edit/{eleve}', [EleveController::class, 'edit'])->name('edit');
   Route::patch('/edtit/{eleve}', [EleveController::class, 'update'])->name('update');
   Route::delete('/delete/{eleve}', [EleveController::class, 'destroy'])->name('delete');
});
