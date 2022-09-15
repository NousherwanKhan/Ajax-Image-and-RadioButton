<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('employee', [EmployeeController::class, 'index']);
Route::post('employee', [EmployeeController::class, 'store']);
Route::get('fetch', [EmployeeController::class, 'fetchemployee']);
Route::get('edit/{id}', [EmployeeController::class, 'edit']);
Route::post('update/{id}', [EmployeeController::class, 'update']);
Route::delete('delete/{id}', [EmployeeController::class, 'destroy']);
