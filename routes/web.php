<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json(['message' => 'Bem-vindo ao Sistema Financeiro']));

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::group(['prefix' => 'turmas', 'as' => 'turmas.'], function () {
//     Route::get('/', [TurmaController::class, 'index'])->name('index');
//     Route::get('/cadastrar', [TurmaController::class, 'create'])->name('create');
//     Route::post('/', [TurmaController::class, 'store'])->name('store');
//     Route::get('/{id}/editar', [TurmaController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [TurmaController::class, 'update'])->name('update');
//     Route::delete('/{id}', [TurmaController::class, 'destroy'])->name('destroy');
// });

// Route::group(['prefix' => 'professores', 'as' => 'professores.'], function () {
//     Route::get('/', [ProfessorController::class, 'index'])->name('index');
//     Route::get('/cadastrar', [ProfessorController::class, 'create'])->name('create');
//     Route::post('/', [ProfessorController::class, 'store'])->name('store');
//     Route::get('/{id}/editar', [ProfessorController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [ProfessorController::class, 'update'])->name('update');
//     Route::delete('/{id}', [ProfessorController::class, 'destroy'])->name('destroy');
// });

// Route::group(['prefix' => 'disciplinas', 'as' => 'disciplinas.'], function () {
//     Route::get('/', [DisciplinaController::class, 'index'])->name('index');
//     Route::get('/cadastrar', [DisciplinaController::class, 'create'])->name('create');
//     Route::post('/', [DisciplinaController::class, 'store'])->name('store');
//     Route::get('/{id}/editar', [DisciplinaController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [DisciplinaController::class, 'update'])->name('update');
//     Route::delete('/{id}', [DisciplinaController::class, 'destroy'])->name('destroy');
// });

// Route::group(['prefix' => 'horarios', 'as' => 'horarios.'], function () {
//     Route::get('/', [HorarioController::class, 'index'])->name('index');
//     Route::get('/cadastrar', [HorarioController::class, 'create'])->name('create');
//     Route::post('/', [HorarioController::class, 'store'])->name('store');
//     Route::get('/{id}/editar', [HorarioController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [HorarioController::class, 'update'])->name('update');
//     Route::delete('/{id}', [HorarioController::class, 'destroy'])->name('destroy');
// });
