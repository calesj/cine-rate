<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Movie\MovieController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('movie/{id}', [MovieController::class, 'show'])->name('movie.show');

/** Rotas que precisam de autenticacao */
Route::group(['middleware' => ['auth', 'throttle:30,1']], function () {
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
});

