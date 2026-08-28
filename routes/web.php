<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ExercicioController;

Route::get('/', function () {
    
    return view('welcome');
});

Route::resource('usuarios', UsuarioController::class);
Route::resource('/exercicios',[ExercicioController::class, 'index']);