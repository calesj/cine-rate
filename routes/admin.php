<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
   Route::get('/', function () {
      dd('oi');
   });
});
