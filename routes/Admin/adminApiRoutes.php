<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('/add-school-vacency-post', [AdminController::class, 'addSchoolVacencyPost']);
