<?php

use App\Http\Controllers\Operator\OperatorController;
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

Route::group(['prefix' => 'operator', 'middleware' => ['buglock.role:web,view,user']], function () {
    // *** All Operator Routes ***
    require __DIR__ . '/Operator/operatorRoutes.php';
});

// *** Start Public Routes ***

// *** Vacency Districts ROutes ***
Route::get('/cuurent-vacency-districts',[OperatorController::class,'cuurentVacencyDistricts'])->name('operator.cuurentVacencyDistricts');
// *** Current Vacency Page ***
Route::get('/cuurent-vacency/{districts?}/{isSlide?}/',[OperatorController::class, 'CurrentVacency'])->name('operator.CurrentVacency');

// *** End Public Routes ***

Route::group(['prefix' => 'operator', 'middleware' => ['buglock.role:web,api,user']], function () {
    // *** All Operator Ppst Routes ***
    require __DIR__ . '/Operator/operatorApiRoutes.php';
});

Route::group(['prefix' => 'admin','middleware' => ['buglock.role:web,view,admin']], function () {
    // *** All Admin View Routes ***
    require __DIR__ . '/Admin/adminViewRoutes.php';
});

Route::group(['prefix' => 'admin','middleware' => ['buglock.role:web,api,admin']], function () {
    // *** All Admin API Routes ***
    require __DIR__ . '/Admin/adminApiRoutes.php';
});
