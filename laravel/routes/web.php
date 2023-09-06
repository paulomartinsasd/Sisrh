<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CargoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

/* Rotas de Funcionários */
Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::get('/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');

Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

/* Rotas de Cargos */
Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::get('/cargos/create', [CargoController::class, 'create'])->name('cargos.create');
Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');
Route::get('/cargos/{id}/edit', [CargoController::class, 'edit'])->name('cargos.edit');
Route::put('/cargos/{id}', [CargoController::class, 'update'])->name('cargos.update');
Route::delete('/cargos/{id}', [CargoController::class, 'destroy'])->name('cargos.destroy');
