<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/departments', function () {
    return view('add');
});
Route::post('/adddepartment', [DepartmentController::class, 'create']);
Route::get('/getdepartment', [DepartmentController::class, 'get']);
Route::get('/department/edit/{id}', [DepartmentController::class, 'edit']);
Route::post('/updatedepartment/{id}', [DepartmentController::class, 'update']);
Route::delete('/deletedepartment/{id}', [DepartmentController::class, 'delete']);

Route::get('/users', function () {
    return view('adduser');
});

Route::post('/adduser', [UserController::class, 'create']);
Route::get('/getuser', [UserController::class, 'get']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/updateuser/{id}', [UserController::class, 'update']);
Route::delete('/deleteuser/{id}', [UserController::class, 'delete']);