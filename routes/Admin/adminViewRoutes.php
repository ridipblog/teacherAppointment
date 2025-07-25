<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// *** School Vacency Details ***
Route::get('/school-details', [AdminController::class, 'schoolDetailsView'])->name('admin.schoolDetailsView');

// *** School  Details And Vacency Data Form Route ***
Route::get('/add-school-vacency/{form?}/{schoolCode?}', [AdminController::class, 'addSchoolVacency'])->name('admin.addSchoolVacency');

// *** Dashboard ROute ***
Route::get('/', [AdminController::class, 'index'])->name('admin.index');

// *** Report Page ***
Route::get('/report-page/{page?}', [AdminController::class, 'reportPage'])->name('admin.reportPage');

// *** Candidate Data List ***
Route::get('/candidate', [AdminController::class, 'candidateList'])->name('admin.candidateList');

// *** Candidate Full Details ***
Route::get('/candidate-details/{id?}', [AdminController::class, 'candidateFullDetails'])->name('admin.candidateFullDetails');
