<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
});

Route::group([
    'middleware' => 'auth:api',
    'middleware' => 'check-role'
], function() {
     Route::get('rentalCars', [CarController::class, 'get']);
     Route::post('rentalCars', [CarController::class, 'create']);
     Route::get('rentalCars/{company_name}/{vehicle_number}', [CarController::class, 'edit']);
     Route::post('rentalCars/{company_name}/{vehicle_number}', [CarController::class, 'update']);
     Route::delete('rentalCars/{company_name}/{vehicle_number}', [CarController::class, 'delete']);

});
