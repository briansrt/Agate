<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CampañaController;
use App\Http\Controllers\TiposAnuncioController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AdicionarPersonalController;
use App\Http\Controllers\AdicionarNotaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cliente', ClienteController::class);
Route::resource('contacto', ContactoController::class);
Route::resource('campaña', CampañaController::class);
Route::resource('tiposanuncio', TiposAnuncioController::class);
Route::resource('anuncio', AnuncioController::class);
Route::resource('adicionarpersonal', AdicionarPersonalController::class);
Route::resource('adicionarnota', AdicionarNotaController::class);

Route::get('/CampañaPorCliente/{codigocliente}', [CampañaController::class, 'CampañaPorCliente']);
Route::get('/AnuncioPorCampaña/{codigocampana}', [AnuncioController::class, 'AnuncioPorCampaña']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


