<?php

use App\Http\Controllers\API\TransacaoController;
use App\Http\Controllers\API\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', fn() => response()->json(['message' => 'Bem-vindo a API Sistema Financeiro']));

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::delete('/usuarios', [UsuarioController::class, 'delete']);

Route::post('/transacoes', [TransacaoController::class, 'store']);
Route::delete('/transacoes/{id}', [TransacaoController::class, 'delete']);
