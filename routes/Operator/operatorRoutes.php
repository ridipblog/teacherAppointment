<?php

use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Support\Facades\Route;

Route::get('/',[OperatorController::class, 'index'])->name('operator.index');
