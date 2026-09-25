<?php


use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\FichaEsportivaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\ParceiroController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\AulaController;



    Route::middleware('guest')->group(function () {
    Route::get('/',[loginController::class, 'index'])->name('login.index');
    Route::get('/login',[loginController::class, 'store'])->name('login.store');
});
    Route::post('/logout', [loginController::class, 'destroy'])->name('login.destroy');



Route::resource('usuarios', UsuarioController::class)->middleware('auth');
Route::resource('fichas-esportivas', FichaEsportivaController::class)
    ->parameters(['fichas-esportivas' => 'ficha'])->middleware('auth');
Route::resource('matriculas', MatriculaController::class)
    ->parameters(['matriculas' => 'matricula'])->middleware('auth'); 



Route::controller(ProfessorController::class)->middleware('auth')->group(function () {
    Route::get('/professores', 'index')->name('professores.index');
    Route::get('/professores/create', 'create')->name('professores.create');
    Route::post('/professores', 'store')->name('professores.store');
    Route::get('/professores/{professor}', 'show')->name('professores.show');
    Route::get('/professores/{professor}/edit', 'edit')->name('professores.edit');
    Route::put('/professores/{professor}', 'update')->name('professores.update');
    Route::patch('/professores/{professor}', 'update')->name('professores.update');
    Route::delete('/professores/{professor}', 'destroy')->name('professores.destroy');
});

Route::controller(PlanoController::class)->middleware('auth')->group(function () {
    Route::get('/planos', 'index')->name('planos.index');
    Route::get('/planos/create', 'create')->name('planos.create');
    Route::post('/planos', 'store')->name('planos.store');
    Route::get('/planos/{plano}', 'show')->name('planos.show');
    Route::get('/planos/{plano}/edit', 'edit')->name('planos.edit');
    Route::put('/planos/{plano}', 'update')->name('planos.update');
    Route::patch('/planos/{plano}', 'update')->name('planos.update');
    Route::delete('/planos/{plano}', 'destroy')->name('planos.destroy');
});

Route::controller(ParceiroController::class)->middleware('auth')->group(function () {
    Route::get('/parceiros', 'index')->name('parceiros.index');
    Route::get('/parceiros/create', 'create')->name('parceiros.create');
    Route::post('/parceiros', 'store')->name('parceiros.store');
    Route::get('/parceiros/{parceiro}', 'show')->name('parceiros.show');
    Route::get('/parceiros/{parceiro}/edit', 'edit')->name('parceiros.edit');
    Route::put('/parceiros/{parceiro}', 'update')->name('parceiros.update');
    Route::patch('/parceiros/{parceiro}', 'update')->name('parceiros.update');
    Route::delete('/parceiros/{parceiro}', 'destroy')->name('parceiros.destroy');
});

Route::controller(TreinoController::class)->middleware('auth')->group(function () {
    Route::get('/treinos', 'index')->name('treinos.index');
    Route::get('/treinos/create', 'create')->name('treinos.create');
    Route::post('/treinos', 'store')->name('treinos.store');
    Route::get('/treinos/{treino}', 'show')->name('treinos.show');
    Route::get('/treinos/{treino}/edit', 'edit')->name('treinos.edit');
    Route::put('/treinos/{treino}', 'update')->name('treinos.update');
    Route::patch('/treinos/{treino}', 'update')->name('treinos.update');
    Route::delete('/treinos/{treino}', 'destroy')->name('treinos.destroy');
});

Route::controller(ProfissionalController::class)->middleware('auth')->group(function () {
    Route::get('/profissionais', 'index')->name('profissionais.index');
    Route::get('/profissionais/create', 'create')->name('profissionais.create');
    Route::post('/profissionais', 'store')->name('profissionais.store');
    Route::get('/profissionais/{profissional}', 'show')->name('profissionais.show');
    Route::get('/profissionais/{profissional}/edit', 'edit')->name('profissionais.edit');
    Route::put('/profissionais/{profissional}', 'update')->name('profissionais.update');
    Route::patch('/profissionais/{profissional}', 'update')->name('profissionais.update');
    Route::delete('/profissionais/{profissional}', 'destroy')->name('profissionais.destroy');
});

Route::controller(ExercicioController::class)->middleware('auth')->group(function () {
    Route::get('/exercicios', 'index')->name('exercicios.index');
    Route::get('/exercicios/create', 'create')->name('exercicios.create');
    Route::post('/exercicios', 'store')->name('exercicios.store');
    Route::get('/exercicios/{exercicio}', 'show')->name('exercicios.show');
    Route::get('/exercicios/{exercicio}/edit', 'edit')->name('exercicios.edit');
    Route::put('/exercicios/{exercicio}', 'update')->name('exercicios.update');
    Route::patch('/exercicios/{exercicio}', 'update')->name('exercicios.update');
    Route::delete('/exercicios/{exercicio}', 'destroy')->name('exercicios.destroy');
});

Route::controller(AulaController::class)->middleware('auth')->group(function () {
    Route::get('/aulas', 'index')->name('aulas.index');
    Route::get('/aulas/create', 'create')->name('aulas.create');
    Route::post('/aulas', 'store')->name('aulas.store');
    Route::get('/aulas/{aula}', 'show')->name('aulas.show');
    Route::get('/aulas/{aula}/edit', 'edit')->name('aulas.edit');
    Route::put('/aulas/{aula}', 'update')->name('aulas.update');
    Route::patch('/aulas/{aula}', 'update')->name('aulas.update');
    Route::delete('/aulas/{aula}', 'destroy')->name('aulas.destroy');
});