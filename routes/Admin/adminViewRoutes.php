<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/add-school-vacency', [AdminController::class, 'addSchoolVacency'])->name('admin.addSchoolVacency');
