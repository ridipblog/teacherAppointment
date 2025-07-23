<?php

use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Support\Facades\Route;

// *** Dashboard Page ***
Route::get('/',[OperatorController::class, 'index'])->name('operator.index');

// *** Current Vacency Page ***
Route::get('/cuurent-vacency',[OperatorController::class, 'CurrentVacency'])->name('operator.CurrentVacency');

// *** Search Candidate By Roll ***
Route::get('/search-cand-roll/{candRoll?}',[OperatorController::class, 'searchCandRoll'])->name('operator.searchCandRoll');

// *** Download Appoint By Cand Roll ***
Route::get('/download-appoint/{candRoll?}',[OperatorController::class, 'downloadAppoint'])->name('operator.downloadAppoint');
