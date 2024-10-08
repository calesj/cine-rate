<?php

use App\Http\Controllers\Admin\GenreController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
   Route::get('/', function () {
      return view('admin.pages.index');
   });

    /** Categoria */
    Route::prefix('genre')->group(function () {
        /** Listar */
        Route::get('/', [GenreController::class, 'index'])->name('admin.genre.index');
        Route::get('{id}/show', [GenreController::class, 'show'])->name('admin.genre.show');

        /** Cadastrar Genero */
        Route::get('create', [GenreController::class, 'create'])->name('admin.genre.create');

        Route::post('toggle-status', [GenreController::class, 'toggleStatus'])->name('admin.genre.toggleStatus');


    });
});
