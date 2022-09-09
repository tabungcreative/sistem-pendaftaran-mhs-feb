<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkripsiController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/daftar/{nim}', [HomeController::class, 'daftar']);
Route::get('/daftar/{nim}/skripsi', [HomeController::class, 'daftarSkripsi'])->name('daftar-skripsi');


Route::controller(SkripsiController::class)->name('skripsi.')->prefix('skripsi')->group(function() {
    Route::get('/{nim}/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});