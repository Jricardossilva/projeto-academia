<?php


use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\FichaEsportivaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PlanosController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\ParceiroController;


Route::get('/', function () {
    
    return view('welcome');
});

Route::resource('usuarios', UsuarioController::class);
Route::resource('exercicios', ExercicioController::class);
Route::resource('profissionais', ProfissionalController::class);
Route::resource('fichas-esportivas', FichaEsportivaController::class);
Route::resource('matriculas', MatriculaController::class);
Route::resource('planos', PlanosController::class);
Route::resource('treinos', TreinoController::class);
Route::resource('parceiros', ParceiroController::class);

// Route::get('/exercicios', [ExercicioController::class, 'index'])->name('exercicios.index');
// Route::get('/exercicios/create', [ExercicioController::class, 'create'])->name('exercicios.create');
// Route::post('/exercicios', [ExercicioController::class, 'store'])->name('exercicios.store');
// Route::get('/exercicios/{exercicio}', [ExercicioController::class, 'show'])->name('exercicios.show');
// Route::get('/exercicios/{exercicio}/edit', [ExercicioController::class, 'edit'])->name('exercicios.edit');
// Route::put('/exercicios/{exercicio}', [ExercicioController::class, 'update'])->name('exercicios.update');
// Route::patch('/exercicios/{exercicio}', [ExercicioController::class, 'update'])->name('exercicios.update');
// Route::delete('/exercicios/{exercicio}', [ExercicioController::class, 'destroy'])->name('exercicios.destroy');



// Route::controller(ExercicioController::class)->group(function () {
//     Route::get('/exercicios', 'index')->name('exercicios.index');
//     Route::get('/exercicios/create', 'create')->name('exercicios.create');
//     Route::post('/exercicios', 'store')->name('exercicios.store');
//     Route::get('/exercicios/{exercicio}', 'show')->name('exercicios.show');
//     Route::get('/exercicios/{exercicio}/edit', 'edit')->name('exercicios.edit');
//     Route::put('/exercicios/{exercicio}', 'update')->name('exercicios.update');
//     Route::patch('/exercicios/{exercicio}', 'update')->name('exercicios.update');
//     Route::delete('/exercicios/{exercicio}', 'destroy')->name('exercicios.destroy');
// });

