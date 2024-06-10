<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CampañaController;
use App\Http\Controllers\TiposAnuncioController;
use App\Http\Controllers\AnuncioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cliente', ClienteController::class);
Route::resource('contacto', ContactoController::class);
Route::resource('campaña', CampañaController::class);
Route::resource('tiposanuncio', TiposAnuncioController::class);
Route::resource('anuncio', AnuncioController::class);

Route::get('/CampañaPorCliente/{codigocliente}', [CampañaController::class, 'CampañaPorCliente']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


