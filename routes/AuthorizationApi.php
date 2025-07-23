<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorization\AuthrizzationController;

// *** Login Post Route ***
Route::post('/login-post',[AuthrizzationController::class, 'loginPost']);
