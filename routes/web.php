<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// *** Auth routes ****
require __DIR__ . '/Authorization.php';

// *** Auth API routes ****
require __DIR__ . '/AuthorizationApi.php';

Route::group(['prefix' => 'operator','middleware'=>['checkAuthorized:view']], function () {
    // *** All Operator Routes ***
    require __DIR__ . '/Operator/operatorRoutes.php';
});


Route::group(['prefix' => 'operator','middleware'=>['checkAuthorized:api']], function () {
    // *** All Operator Ppst Routes ***
    require __DIR__ . '/Operator/operatorApiRoutes.php';
});
