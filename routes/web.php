<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
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

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('submit_form', 'store')->name('submit_form');
});

Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
