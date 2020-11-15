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

Route::prefix('admin')->group(function(){

    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'ShowLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'Login'])->name('admin.login.submit');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

});


Route::prefix('employee')->group(function(){
    Route::get('/login', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'ShowLoginForm'])->name('employee.login');
    Route::post('/login', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'Login'])->name('employee.login.submit');
    Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.dashboard');

});