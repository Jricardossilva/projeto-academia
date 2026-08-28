<?php


use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ExercicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return view('welcome');
});

Route::resource('usuarios', UsuarioController::class);
Route::resource('exercicios', ExercicioController::class);