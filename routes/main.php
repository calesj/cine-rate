<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\Movie\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('movie/{id}', [MovieController::class, 'show'])->name('movie.show');

/** Rotas que precisam de autenticacao */
Route::group(['middleware' => ['auth', 'throttle:30,1']], function () {
    /** Favorita ou remove dos favoritos */
    Route::post('favorite', [FavoriteController::class, 'store'])->name('favorite.store');

    /** Lista os filmes favoritos do usuario logado */
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites');

    /** Dashboard Perfil */
    Route::get('dashboard', [MovieController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'review'], function () {
        /** Da like ou dislike em um review */
        Route::post('like', [ReviewController::class, 'like'])->name('review.like');

        Route::post('store', [ReviewController::class, 'store'])->name('review.store');

        Route::put('{id}/update', [ReviewController::class, 'update'])->name('review.update');

        Route::delete('{id}/delete', [ReviewController::class, 'destroy'])->name('review.destroy');
    });
});

