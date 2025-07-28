<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// *** Add and update school details routes ***
Route::post('/add-school-vacency-post', [AdminController::class, 'addSchoolVacencyPost']);

// *** delete vacency details row ***
Route::post('/delete-vacency-row', [AdminController::class, 'deleteVacencyDetails']);

// *** delete school details ***
Route::post('/delete-school-details', [AdminController::class, 'deleteSchoolDetails']);

// *** Revert Allocated Candidate  ****
Route::post('/revert-allocated-candidate', [AdminController::class, 'candidateRevert']);

// *** Add user post ***
Route::post('/add-user-post', [AdminController::class, 'addUserPost'])->name('admin.addUserPost');

// *** Deactive user ***
Route::post('/deactive-user', [AdminController::class, 'deactiveUser'])->name('admin.deactiveUser');
