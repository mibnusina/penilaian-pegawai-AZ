<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController; // example use controller
use App\Http\Controllers\testController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\homeController;

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

// Route::get('/test', [App\Http\Controllers\testController::class, 'index'])->name('home'); example route
Route::get('/test', [testController::class, 'addDefaultUser'])->name('test');
Route::get('/', [loginController::class, 'login'])->name('login');
Route::post('/action-login', [loginController::class, 'actionLogin'])->name('action-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [homeController::class, 'index'])->name('home');
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');
});