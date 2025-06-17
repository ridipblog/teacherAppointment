<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authorization\AuthrizzationController;

// *** Login Routes ***
Route::get('/login',[AuthrizzationController::class, 'login'])->name('auth.login');
