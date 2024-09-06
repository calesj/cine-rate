<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])->name('home');

/** Rotas que precisam de autenticacao */
Route::group(['middleware' => 'auth'], function () {
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
});

