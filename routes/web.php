<?php

use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListeController::class, 'index'])->name('liste');
