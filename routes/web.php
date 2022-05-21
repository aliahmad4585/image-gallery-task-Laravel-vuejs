<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/json',  [App\Http\Controllers\PhotoController::class, 'getPhotos']);
Route::post('/fav', [App\Http\Controllers\FavController::class, 'favourite']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
