<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cliente', ClienteController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
