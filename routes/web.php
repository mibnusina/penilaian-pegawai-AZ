<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController; // example use controller
use App\Http\Controllers\testController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\kriteriaController;
use App\Http\Controllers\subKriteriaController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\periodeController;

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

    Route::get('/pegawai', [pegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pegawai/data', [pegawaiController::class, 'getData']);
    Route::get('/pegawai/data-by-id/{id}', [pegawaiController::class, 'getDataById']);
    Route::get('/pegawai/delete/{id}', [pegawaiController::class, 'deleteData']);
    Route::post('/pegawai/post', [pegawaiController::class, 'insertData']);
    Route::post('/pegawai/update', [pegawaiController::class, 'updateData']);

    Route::get('/jabatan', [jabatanController::class, 'index'])->name('jabatan');
    Route::get('/jabatan/data', [jabatanController::class, 'getData']);
    Route::get('/jabatan/data-by-id/{id}', [jabatanController::class, 'getDataById']);
    Route::get('/jabatan/delete/{id}', [jabatanController::class, 'deleteData']);
    Route::post('/jabatan/post', [jabatanController::class, 'insertData']);
    Route::post('/jabatan/update', [jabatanController::class, 'updateData']);

    Route::get('/kriteria', [kriteriaController::class, 'index']);
    Route::get('/kriteria/data', [kriteriaController::class, 'getData']);
    Route::get('/kriteria/data-by-id/{id}', [kriteriaController::class, 'getDataById']);
    Route::get('/kriteria/delete/{id}', [kriteriaController::class, 'deleteData']);
    Route::post('/kriteria/post', [kriteriaController::class, 'insertData']);
    Route::post('/kriteria/update', [kriteriaController::class, 'updateData']);

    Route::get('/sub-kriteria', [SubKriteriaController::class, 'index'])->name('sub-kriteria');
    Route::get('/sub-kriteria/{kriteria_id}', [SubKriteriaController::class, 'indexKriteriaId']);
    Route::get('/sub-kriteria/{kriteria_id}/data', [SubKriteriaController::class, 'getData']);
    Route::get('/sub-kriteria/data-by-id/{id}', [SubKriteriaController::class, 'getDataById']);
    Route::get('/sub-kriteria/delete/{id}', [SubKriteriaController::class, 'deleteData']);
    Route::post('/sub-kriteria/post', [SubKriteriaController::class, 'insertData']);
    Route::post('/sub-kriteria/update', [SubKriteriaController::class, 'updateData']);

    Route::get('/periode', [periodeController::class, 'index'])->name('periode');
    Route::get('/periode/data', [periodeController::class, 'getData']);
    Route::get('/periode/data-by-id/{id}', [periodeController::class, 'getDataById']);
    Route::get('/periode/delete/{id}', [periodeController::class, 'deleteData']);
    Route::post('/periode/post', [periodeController::class, 'insertData']);
    Route::post('/periode/update', [periodeController::class, 'updateData']);

    Route::get('/penilaian', [penilaianController::class, 'index']);
    Route::get('/penilaian/{periodeId}', [penilaianController::class, 'indexPeriodeId']);
    Route::get('/penilaian/{periodeId}/tambah', [penilaianController::class, 'indexSubmitPenilaian']);
    Route::get('/penilaian-by-periode/{periodeId}/data', [penilaianController::class, 'dataPenilaianByPeriodeId']);
    Route::post('/penilaian/post', [penilaianController::class, 'insertData']);
    Route::post('/penilaian/approve', [penilaianController::class, 'approveData']);

    Route::get('/kriteria-sub-kriteria', [SubKriteriaController::class, 'kriteriaSubKriteria']);
});