<?php

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

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;

Route::get('/', function () {
    return view('auth/login');
})->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/download-history/{hash}', [FilesController::class, 'downloadHistory'])->name('files.download');

    Route::group(['prefix' => 'cargoes'], function () {
        Route::get('arrival', [CargoController::class, 'arrival'])->name('cargoes.arrival');
        Route::get('departure', [CargoController::class, 'departure'])->name('cargoes.departure');
        Route::get('terminal', [CargoController::class, 'terminal'])->name('cargoes.terminal');
        Route::get('create', [CargoController::class, 'create'])->name('cargoes.create');
        Route::get('{cargo}/edit', [CargoController::class, 'edit'])->name('cargoes.edit');
        Route::get('search', [CargoController::class, 'search'])->name('cargoes.search');
        Route::get('{cargo}', [CargoController::class, 'show'])->name('cargoes.show');
        Route::post('{cargo}', [CargoController::class, 'update'])->name('cargoes.update');
        Route::post('', [CargoController::class, 'store'])->name('cargoes.store');
        Route::delete('{cargo}', [CargoController::class, 'destroy'])->name('cargoes.destroy');
        Route::post('{cargo}/comment', [CargoController::class, 'comment'])->name('cargoes.comment');

        Route::group(['prefix' => 'departure'], function () {
            Route::get('create', [CargoController::class, 'departureCreate'])->name('cargoes.departure.create');
            Route::post('store', [CargoController::class, 'departureStore'])->name('cargoes.departure.store');
        });
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('users', UserController::class);
    });
});

