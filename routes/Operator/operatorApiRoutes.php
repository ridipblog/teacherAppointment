<?php

use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Support\Facades\Route;

// *** Search Candidate By Roll ***
Route::post('/search-cand-roll',[OperatorController::class, 'searchCandRoll']);

// *** Search School Code with Vacency ***
Route::post('/search-vacent-code',[OperatorController::class, 'searchVacencyByCode']);
