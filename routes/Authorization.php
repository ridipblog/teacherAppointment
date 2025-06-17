<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authorization\AuthrizzationController;

// *** Login Routes ***
Route::get('/',[AuthrizzationController::class, 'login'])->name('auth.login');
