<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employee/export', [App\Http\Controllers\EmployeeController::class, 'doExport'])->name('export');
Route::get('/employee/statistic', [App\Http\Controllers\EmployeeController::class, 'getStatistic'])->name('statistic');
Route::get('/employee/export-statistic', [App\Http\Controllers\EmployeeController::class, 'exportStatistic'])->name('exportStatistic');
